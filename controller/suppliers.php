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

// Default: redirect to view
header('Location: ../views/Suppliers.php');
exit();
?>



