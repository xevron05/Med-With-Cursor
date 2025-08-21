<?php
require "../php-config/Connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $medicineName = trim($_REQUEST['medicineName']);
    $companyName = trim($_REQUEST['companyName']);
    $unit = trim($_REQUEST['unit']);

    $moneyType = "";
    if ($_REQUEST['moneyType'] == 'Nepali'){
        $moneyType = 1;
    } elseif ($_REQUEST['moneyType'] == 'Indian'){
        $moneyType = 2;
    }

    $checkQuery = "SELECT * FROM medicines where MEDICINENAME = '$medicineName'";
    $done = $conn->query($checkQuery);
    $row = $done->fetch_assoc();
    if ($row['MEDICINENAME'] == $medicineName ){
        echo "<script>document.getElementById(`existMedicine`).innerHTML=`<p class='medicineAlreadyExist'>Medicine already exist</p>`</script>";
    }
    else{
        $sql = "INSERT INTO medicines(MEDICINENAME, COMPANYNAME, UNIT, MONEYTYPE) VALUES ('$medicineName', '$companyName', '$unit', '$moneyType')";
        $conn->query($sql);
        echo "<script>document.getElementById('existMedicine').innerHTML=`<p class='medicineInserted'>Medicine Inserted Successfully.</p>`;</script>";
        header("Location: ../views/MedicineDetails.php?success=1");
        exit();
    }
    header("Location: ../views/MedicineDetails.php?success=0");
    exit();
}
