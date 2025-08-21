<?php //require "../controller/isLogin.php"
?>
<?php require "../controller/user-data.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDSOFT</title>
    <link rel="stylesheet" href="../public/css/Navigation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="nav">
    <div class="container">
        <nav>
            <div class="logo">
                <img src="../public/images/logo.png" alt="Logo">
                <a href="./Home.php"></a>
                <span>MEDSOFT</span>
            </div>

            <div class="user-profile">

                <img src="../public/images/<?php echo $row['PROFILEPICTURE'] ?>">

                <span class="name"><?php echo $row['FULLNAME'] ?></span>
                <i class="fa-solid fa-caret-down" id="dropdown-icon" onclick="toggleUserControl()"></i>
                <div class="user-control" id="user-control">
                    <li><a href="../controller/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout </a></li>
                    <li><a href="setting.php"><i class="fa-solid fa-gear"></i> Settings </a></li>
                    <li><a href="NeedHelp.php"><i class="fa-solid fa-question"></i> Need Helps </a></li>
                </div>
            </div>
        </nav>
        <script>
            document.getElementById('user-control').style.display = 'none';

            function toggleUserControl() {
                var userControl = document.getElementById('user-control');
                if (userControl.style.display === 'none') {
                    userControl.style.display = '';
                    document.getElementById('dropdown-icon').classList.remove('fa-caret-down');
                    document.getElementById('dropdown-icon').classList.add('fa-caret-up');
                } else {
                    userControl.style.display = 'none';
                    document.getElementById('dropdown-icon').classList.remove('fa-caret-up');
                    document.getElementById('dropdown-icon').classList.add('fa-caret-down');
                }
            }
        </script>
</body>

</html>