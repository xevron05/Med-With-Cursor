<?php
require "../php-config/Connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $deleteId = $_REQUEST['ID'];
    $sql = "DELETE FROM medicines WHERE `SN` = $deleteId";
    $conn->query('SET FOREIGN_KEY_CHECKS=0');
    $done = $conn->query($sql);
    if ($done){
        header("Location: ../views/MedicineDetails.php?delete=1");
        exit();
    }
    header("Location: ../views/MedicineDetails.php?delete=0");
    exit();
}