<?php session_start();?>
<?php require "../controller/isLogin.php"?>
<?php require "../controller/fatchMedicine-sales.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="../public/css/Sales.css">

</head>
<body>
<div class="container">
<iframe src="sales-medicine.php" class="firstFrame" width="58%" height="960px"></iframe>
<iframe src="bill.php" class="SecondFrame" width="42%" height="960px" ></iframe>
</div>

<footer class="Footer">
    &copy;copyright <b>MEDSOFT</b>. All Rights Reserved <br> Design by 💙 <b>medsoft</b>
</footer>
</body>
</html>
