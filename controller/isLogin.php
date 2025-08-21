<?php

try {
//    session_start();
    if (!isset($_SESSION['userId'])) {
        header("Location: ../views/Login.php");
        exit();
    }
} catch (Exception $e){
}
