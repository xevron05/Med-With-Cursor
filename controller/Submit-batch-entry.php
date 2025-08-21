<?php
require "../php-config/Connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
//    print_r($_REQUEST);
    $batchNumber = $_REQUEST['batchNo'];
    $expiry = date('Y-m-d', strtotime($_POST['expiry']));

    $quantity = (int)$_REQUEST['quantity'];
    $mrp = 0;
    $medId = (int)$_REQUEST['medId'];
    $supplierId = isset($_REQUEST['supplierId']) ? (int)$_REQUEST['supplierId'] : null;
    $importDate = isset($_REQUEST['importDate']) ? date('Y-m-d', strtotime($_REQUEST['importDate'])) : date('Y-m-d');

    $medicineDataSql = "SELECT * FROM medicines where SN = $medId";
    $done = $conn-> query($medicineDataSql);

    $row = $done->fetch_assoc();
    if($row['MONEYTYPE'] == '2'){
        $mrp = $_REQUEST['mrp'] * 1.6;
    } else if($row['MONEYTYPE'] == '1'){
        $mrp = $_REQUEST['mrp'] ;
    } else{
        echo "EROOR";
    }
//    echo "Hello";
//    echo $expiry;


        // Ensure schema has supplier_id and import_date
        $conn->query("ALTER TABLE medicinebatch ADD COLUMN IF NOT EXISTS supplier_id INT NULL");
        $conn->query("ALTER TABLE medicinebatch ADD COLUMN IF NOT EXISTS import_date DATE NULL");
        $conn->query("ALTER TABLE medicinebatch ADD INDEX IF NOT EXISTS idx_supplier (supplier_id)");
        
        $sql = "INSERT INTO medicinebatch(MED_ID, BATCHNUMBER, EXPIRYDATE, QUANTITY, MRP, supplier_id, import_date)
        VALUES ($medId, '$batchNumber',STR_TO_DATE('$expiry','%Y-%m-%d') , $quantity, $mrp, " . ($supplierId ?: 'NULL') . ", STR_TO_DATE('$importDate','%Y-%m-%d'))  ";
        $conn->query($sql);
        
        header("Location: ../views/MedicineDetails.php?success=1");
        exit();

    header("Location: ../views/MedicineDetails.php?success=0");
    exit();
}