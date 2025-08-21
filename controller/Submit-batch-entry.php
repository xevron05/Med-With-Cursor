<?php
require "../php-config/Connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
//    print_r($_REQUEST);
    $batchNumber = $_REQUEST['batchNo'];
    $expiry = date('Y-m-d', strtotime($_POST['expiry']));

    $quantity = $_REQUEST['quantity'];
    $mrp = 0;
    $medId = $_REQUEST['medId'];

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


        $sql = "INSERT INTO medicinebatch(MED_ID, BATCHNUMBER, EXPIRYDATE, QUANTITY, MRP)
        VALUES ($medId, '$batchNumber',STR_TO_DATE('$expiry','%Y-%m-%d') , $quantity, $mrp)  ";
        $conn->query($sql);
        
        header("Location: ../views/MedicineDetails.php?success=1");
        exit();

    header("Location: ../views/MedicineDetails.php?success=0");
    exit();
}