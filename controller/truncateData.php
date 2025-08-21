<?php
session_start();
require('../php-config/Connection.php');


// Perform truncation of data
//$sql = "TRUNCATE TABLE soldmedicine";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>
