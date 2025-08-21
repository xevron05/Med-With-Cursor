<?php //session_start();
?>
<?php require "./Navigation.php" ?>
<?php require "../controller/isLogin.php" ?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../public/css/Home.css">
    <script src="https://kit.fontawesome.com/07f79c75c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="d-container">
        <div id="side-panel">
            <h1>Admin Panel</h1>
            <ul>
                <a href="Dashboard.php" target="content-frame">
                    <li><i class="fa-solid fa-gauge"></i>Dashboard</li>
                </a>
                <a href="MedicineDetails.php" target="content-frame">
                    <li><i class="fa-solid fa-newspaper"></i>Medicine Details</li>
                </a>
                <a href="Sales.php" target="content-frame">
                    <li><i class="fa-solid fa-cart-shopping"></i>Sales</li>
                </a>
                <a href="Analytics.php" target="content-frame">
                    <li><i class="fa-solid fa-chart-line"></i>Sales Analytics</li>
                </a>
                <a href="NeedHelp.php" target="content-frame">
                    <li><i class="fa-solid fa-question"></i>Need Help?</li>
                </a>
                <a href="Suppliers.php" target="content-frame">
                    <li><i class="fa-solid fa-truck"></i>Suppliers</li>
                </a>
            </ul>
        </div>
        <div id="content">
            <iframe src="./Dashboard.php" name="content-frame"></iframe>
            <!--    <iframe src="./setting.php"></iframe>-->
        </div>
    </div>

</body>

</html>