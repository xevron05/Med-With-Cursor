<?php
session_start();
require('../php-config/Connection.php');

//$sql = $conn->query("SELECT * FROM medicines INNER JOIN medsoft.soldmedicine s on medicines.SN = s.MED_ID");
//$sql = "SELECT * FROM medicinebatch
//INNER JOIN medicines ON medicinebatch.MED_ID = medicines.SN
//INNER JOIN soldmedicine ON medicinebatch.MED_ID = soldmedicine.MED_ID";

$sql = "SELECT * FROM medicines
INNER JOIN medsoft.medicinebatch m on medicines.SN = m.MED_ID
INNER JOIN soldmedicine s ON s.B_ID = m.B_SN";
$done = $conn -> query($sql);

$soldmedicine = array();

$done = $conn->query($sql);
if ($done->num_rows > 0) {
    while ($row = $done->fetch_assoc()) {
        $soldmedicine[] = $row;
    }
}


// Return data as JSON
//echo json_encode($soldmedicine);

// Close connection
//mysqli_close($conn);

$jsonData = json_encode($soldmedicine);
header('Content-Type: Application/json');
echo $jsonData;


?>