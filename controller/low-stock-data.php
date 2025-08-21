<?php
require('../php-config/Connection.php');
header('Content-Type: application/json');

$threshold = isset($_GET['threshold']) ? (int)$_GET['threshold'] : 5;

$sql = $conn->prepare("SELECT m.MEDICINENAME, mb.BATCHNUMBER, mb.QUANTITY, mb.EXPIRYDATE
    FROM medicinebatch mb
    INNER JOIN medicines m ON m.SN = mb.MED_ID
    WHERE mb.QUANTITY <= ?
    ORDER BY mb.QUANTITY ASC");
$sql->bind_param('i', $threshold);
$sql->execute();
$res = $sql->get_result();
$rows = [];
while($r = $res->fetch_assoc()) { $rows[] = $r; }
echo json_encode(['threshold' => $threshold, 'items' => $rows]);
?>



