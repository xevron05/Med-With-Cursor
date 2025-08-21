<?php
require('../php-config/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "TRUNCATE soldmedicine";
    $conn->query($sql);
}
