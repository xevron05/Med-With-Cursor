<?php
session_start();
//$_SESSION['userId'] = '2';
if(isset($_SESSION['userId'])){
    echo $_SESSION['userId'];
} else{
    echo "session not found";
}

