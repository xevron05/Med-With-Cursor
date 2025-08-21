<?php
require('../php-config/Connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure required tables exist
    $conn->query("CREATE TABLE IF NOT EXISTS bills (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        bill_no VARCHAR(64) NOT NULL,
        bill_date DATETIME NOT NULL,
        customer_name VARCHAR(255) NULL,
        contact_number VARCHAR(64) NULL,
        address VARCHAR(255) NULL,
        total_amount DECIMAL(12,2) NOT NULL DEFAULT 0,
        payment_status VARCHAR(32) NOT NULL DEFAULT 'Paid',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        INDEX (bill_date),
        INDEX (bill_no)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    $conn->query("CREATE TABLE IF NOT EXISTS bill_items (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        bill_id INT NOT NULL,
        medicine_id INT NOT NULL,
        batch_id INT NOT NULL,
        medicine_name VARCHAR(255) NOT NULL,
        quantity INT NOT NULL,
        mrp DECIMAL(12,2) NOT NULL,
        discount_percent DECIMAL(5,2) NOT NULL DEFAULT 0,
        line_total DECIMAL(12,2) NOT NULL,
        CONSTRAINT fk_bill_items_bill FOREIGN KEY (bill_id) REFERENCES bills(id) ON DELETE CASCADE,
        INDEX (medicine_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $customerName = isset($_POST['patient_name']) ? trim($_POST['patient_name']) : null;
    $contactNumber = isset($_POST['contact_number']) ? trim($_POST['contact_number']) : null;
    $address = isset($_POST['address']) ? trim($_POST['address']) : null;
    $paymentStatus = isset($_POST['payment_status']) ? trim($_POST['payment_status']) : 'Paid';
    $clientBillNo = isset($_POST['bill_no']) ? trim($_POST['bill_no']) : null;

    $itemsQuery = "SELECT s.S_ID, s.B_ID, s.QUANTITY, s.DISCOUNT, s.REMARK, 
                          mb.B_SN AS batch_id, mb.MRP, mb.MED_ID, 
                          m.MEDICINENAME
                   FROM soldmedicine s
                   INNER JOIN medicinebatch mb ON s.B_ID = mb.B_SN
                   INNER JOIN medicines m ON mb.MED_ID = m.SN";
    $itemsResult = $conn->query($itemsQuery);

    if (!$itemsResult || $itemsResult->num_rows === 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No items to bill']);
        exit();
    }

    $conn->begin_transaction();
    try {
        $billTotal = 0.0;
        $billItems = [];
        while ($row = $itemsResult->fetch_assoc()) {
            $quantity = (int)$row['QUANTITY'];
            $mrp = (float)$row['MRP'];
            $discountPercent = (float)$row['DISCOUNT'];
            $lineGross = $mrp * $quantity;
            $lineDiscount = ($discountPercent / 100.0) * $lineGross;
            $lineTotal = $lineGross - $lineDiscount;
            $billTotal += $lineTotal;

            $billItems[] = [
                'medicine_id' => (int)$row['MED_ID'],
                'batch_id' => (int)$row['batch_id'],
                'medicine_name' => $row['MEDICINENAME'],
                'quantity' => $quantity,
                'mrp' => $mrp,
                'discount_percent' => $discountPercent,
                'line_total' => $lineTotal,
            ];
        }

        $billNo = $clientBillNo ?: (string)(time() . rand(100, 999));
        $billDate = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO bills (bill_no, bill_date, customer_name, contact_number, address, total_amount, payment_status, created_at)
                                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param(
            'ssssdds',
            $billNo,
            $billDate,
            $customerName,
            $contactNumber,
            $address,
            $billTotal,
            $paymentStatus
        );
        $stmt->execute();
        $billId = $stmt->insert_id;
        $stmt->close();

        $itemStmt = $conn->prepare("INSERT INTO bill_items (bill_id, medicine_id, batch_id, medicine_name, quantity, mrp, discount_percent, line_total)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($billItems as $item) {
            $itemStmt->bind_param(
                'iiisiddd',
                $billId,
                $item['medicine_id'],
                $item['batch_id'],
                $item['medicine_name'],
                $item['quantity'],
                $item['mrp'],
                $item['discount_percent'],
                $item['line_total']
            );
            $itemStmt->execute();
        }
        $itemStmt->close();

        if (isset($_POST['batchNumberArr']) && is_array($_POST['batchNumberArr'])) {
            foreach ($_POST['batchNumberArr'] as $item) {
                $qty = isset($item['quentity']) ? (int)$item['quentity'] : 0;
                $bid = isset($item['bid']) ? (int)$item['bid'] : 0;
                if ($qty > 0 && $bid > 0) {
                    $conn->query("UPDATE medicinebatch SET QUANTITY = QUANTITY - {$qty} WHERE B_SN = {$bid}");
                }
            }
        } else {
            foreach ($billItems as $item) {
                $qty = (int)$item['quantity'];
                $bid = (int)$item['batch_id'];
                $conn->query("UPDATE medicinebatch SET QUANTITY = QUANTITY - {$qty} WHERE B_SN = {$bid}");
            }
        }

        $conn->query("TRUNCATE soldmedicine");

        $conn->commit();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'bill_id' => $billId, 'bill_no' => $billNo, 'total_amount' => $billTotal]);
    } catch (Throwable $e) {
        $conn->rollback();
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Failed to save bill', 'error' => $e->getMessage()]);
    }
}
