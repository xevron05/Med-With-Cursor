<?php
require('../php-config/Connection.php');

// Ensure table exists
$conn->query("CREATE TABLE IF NOT EXISTS suppliers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255) NULL,
    phone VARCHAR(64) NULL,
    email VARCHAR(255) NULL,
    address VARCHAR(255) NULL,
    notes TEXT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $contact = trim($_POST['contact_person'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $notes = trim($_POST['notes'] ?? '');
    if ($name === '') {
        header('Location: ../views/Suppliers.php?success=0&msg=Name required');
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO suppliers (name, contact_person, phone, email, address, notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $name, $contact, $phone, $email, $address, $notes);
    $stmt->execute();
    $stmt->close();
    header('Location: ../views/Suppliers.php?success=1');
    exit();
}

// Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("DELETE FROM suppliers WHERE id = {$id}");
    header('Location: ../views/Suppliers.php?deleted=1');
    exit();
}

// API list
if (isset($_GET['format']) && $_GET['format'] === 'json') {
    header('Content-Type: application/json');
    $q = isset($_GET['q']) ? ('%' . $conn->real_escape_string($_GET['q']) . '%') : null;
    if ($q) {
        $stmt = $conn->prepare("SELECT * FROM suppliers WHERE name LIKE ? OR contact_person LIKE ? OR phone LIKE ? ORDER BY created_at DESC");
        $stmt->bind_param('sss', $q, $q, $q);
    } else {
        $stmt = $conn->prepare("SELECT * FROM suppliers ORDER BY created_at DESC");
    }
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = [];
    while ($r = $res->fetch_assoc()) { $rows[] = $r; }
    echo json_encode($rows);
    exit();
}

// Supplier import report API
if (isset($_GET['format']) && $_GET['format'] === 'report') {
    header('Content-Type: application/json');
    $supplierId = (int)($_GET['supplier_id'] ?? 0);
    $start = $_GET['start'] ?? null;
    $end = $_GET['end'] ?? null;

    // Ensure fields exist in medicinebatch for backward compatibility
    $conn->query("ALTER TABLE medicinebatch ADD COLUMN IF NOT EXISTS supplier_id INT NULL");
    $conn->query("ALTER TABLE medicinebatch ADD COLUMN IF NOT EXISTS import_date DATE NULL");

    $where = "WHERE mb.supplier_id = ?";
    if ($start && $end) { $where .= " AND mb.import_date BETWEEN ? AND ?"; }

    $sql = "SELECT mb.QUANTITY AS import_qty, mb.MRP as rate, 0 AS discount, DATE_FORMAT(mb.import_date,'%Y-%m-%d') as import_date,
                   mb.BATCHNUMBER as batch_no, m.MEDICINENAME as medicine_name
            FROM medicinebatch mb
            JOIN medicines m ON m.SN = mb.MED_ID
            $where
            ORDER BY mb.import_date DESC, mb.B_SN DESC";

    if ($start && $end) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iss', $supplierId, $start, $end);
    } else {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $supplierId);
    }
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = [];
    while ($r = $res->fetch_assoc()) { $rows[] = $r; }
    echo json_encode($rows);
    exit();
}

// Default: redirect to view
header('Location: ../views/Suppliers.php');
exit();
?>



