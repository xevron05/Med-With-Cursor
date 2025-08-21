<?php
require('../php-config/connection.php');

$id = $_POST['id'];


$sql = "DELETE FROM soldmedicine WHERE S_ID = '$id'";
$conn->query($sql);