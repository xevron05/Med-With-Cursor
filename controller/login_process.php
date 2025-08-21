<?php
require "../php-config/Connection.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $uname = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql = "SELECT * FROM users WHERE USERNAME = '$uname'";

    $done = $conn->query($sql);

    if ($done) {

        $row = $done->fetch_assoc();
        if (isset($row['PASSWORD'])) {
            $actualPassword = $row['PASSWORD'];
            if (password_verify($password, $actualPassword)) {
                $_SESSION['userId'] = $row['SN'];
                header("Location: ../views/Home.php");
                exit();
            } else {
                header("Location: ../views/Login.php?notmatch='1'");
            }
        } else {
            header("Location: ../views/Login.php?noaccount='1'");
            exit();
        }
        }

        $conn->close();


    }