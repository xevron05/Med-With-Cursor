<?php
session_start();
include "../php-config/Connection.php";

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $user_id = $_POST['id'];
//    $username = $_POST['username'];
//    $email = $_POST['email'];
//    $password = $_POST['password'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $sn = $_SESSION['userId'];
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $fullname = $fname." ".$lname;
    $uname = $_POST['uname'];
    $password = trim($_POST['password']);
//    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'];

    // Update user data in the database
    $sql = "UPDATE users SET fname='$fname', lname='$lname' fullname='$fullname', password='$password',
    phone='$phone' email='$email', gender='$gender' WHERE `SN` ='$sn'";

    if ($conn->query($sql) === TRUE) {
        echo "Update successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
