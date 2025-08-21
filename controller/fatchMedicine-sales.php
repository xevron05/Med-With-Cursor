<?php
//require  "../php-config/Connection.php";
//
//if($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//    $medicineName = trim($_REQUEST['medicineName']);
//    $batchNumber = trim($_REQUEST['batchNumber']);
//    $remainingQuantity = trim($_REQUEST['remainingQuantity']);
//
//
////    $sql = "INSERT INTO sales (MEDICINENAME, BATCHNUMBER, REMAININGQUANTITY)
////        VALUES ($medicineName, '$batchNumber'$remainingQuantity)";
////    $conn->query($sql);
//
////    $sql = "SELECT * FROM sales where MEDICINENAME = '$medicineName', BATCHNUMBER = '$batchNumber', REMAININGQUANTITY= '$remainingQuantity' ";
//
//  $sql= $conn->query( "  SELECT * FROM medicinebatch
//INNER JOIN medsoft.medicines m on medicinebatch.MED_ID = m.SN
//INNER JOIN medsoft.currency c on medicinebatch.CURRENCY_TYPE = c.C_ID"
//  );
//
////    $sql = "SELECT * FROM medicinebatch";
////    $nr_of_rows = $sql->num_rows;
//
//    $done = $conn->query($sql);
//    $row = $done->fetch_assoc();
//}
//
//
//?>