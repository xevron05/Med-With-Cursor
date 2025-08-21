<?php
// Start the session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../php-config/Connection.php';
//$row = '';
if (isset($_SESSION['userId'])) {
    $sn = $_SESSION['userId'];
    $sql = "SELECT * FROM `users` WHERE `SN` ='$sn' ";
    $done = $conn->query($sql);

        $row = $done->fetch_assoc();

}