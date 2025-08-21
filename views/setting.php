<?php //require "../controller/isLogin.php";
require "../controller/user-data.php" ;
//print_r($row);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setting</title>
    <link rel="stylesheet" href="../public/css/setting.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
<div class="container">
    <div class="edit-profile">
        <h1>Edit Profile</h1>

        <img src="../public/images/<?php

        echo $row['PROFILEPICTURE'];?>">

        <span class="name"><?php echo $row['FULLNAME']; ?></span>

        <form action="">
        <label for="username">Username: <?php echo $row['USERNAME']; ?></label><br>
        <label for="phoneNumber">Phone Number: <?php echo $row['PHONENUMBER']; ?></label><br>
        <label for="email">Email: <?php echo $row['EMAIL']; ?></label><br>
        <label for="gender">Gender: <?php echo $row['GENDER']; ?></label><br>
            <div class="action">
                <button id="delete-user"><li><a href="../controller/delete-user.php">Delete User</a></li></button>
                <button id="edit-user"><li><a href="edit-user.php">Edit User</a></li></button>
            </div>
        </form>

    </div>

    <div class="add-user">
        <li><a href="Register.php"><i class="fa-solid fa-user-plus"></i></a></li>
        <h3>Add new User</h3>
    </div>
</div>
</body>
</html>
