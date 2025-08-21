<?php
session_start();
require('../php-config/connection.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set in $_POST
    if (isset($_POST['batchId'], $_POST['quantity'])) {
            $batchId = $_REQUEST['batchId'] ;
             $quantity = intval($_REQUEST['quantity']);
            $discount =intval( $_REQUEST['discount'])  ;
            $remark = $_REQUEST['remark']  ;

        // Insert data into the database
        $sql = "INSERT INTO soldmedicine(QUANTITY, DISCOUNT, REMARK, B_ID) VALUES  ('$quantity','$discount',  '$remark', '$batchId')";

        if ($conn->query($sql) === TRUE) {
            // Data insertion successful
            header("Location: ../views/sales-medicine.php?success=1");
            exit();
        } else {
            // Error in data insertion
            header("Location: ../views/sales-medicine.php?success=0");
            exit();
        }
    } else {
        // If any required field is missing
        header("Location: ../views/sales-medicine.php?success=0");
        exit();
    }
} else {
    // Handle other HTTP request methods (if needed)
    header("Location: ../views/sales-medicine.php?success=0");
    exit();
}

// Close database connection
$conn->close();

