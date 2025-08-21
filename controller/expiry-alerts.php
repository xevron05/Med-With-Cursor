<?php
require('../php-config/Connection.php');
header('Content-Type: application/json');

$days = isset($_GET['days']) ? (int)$_GET['days'] : 30;
$today = date('Y-m-d');
$limitDate = date('Y-m-d', strtotime("+{$days} days"));

$sql = $conn->prepare("SELECT m.MEDICINENAME, mb.BATCHNUMBER, mb.EXPIRYDATE, mb.QUANTITY
    FROM medicinebatch mb
    INNER JOIN medicines m ON m.SN = mb.MED_ID
    WHERE mb.EXPIRYDATE BETWEEN ? AND ?
    ORDER BY mb.EXPIRYDATE ASC");
$sql->bind_param('ss', $today, $limitDate);
$sql->execute();
$res = $sql->get_result();
$rows = [];
while($r = $res->fetch_assoc()) { $rows[] = $r; }
echo json_encode(['days' => $days, 'items' => $rows]);
?>



