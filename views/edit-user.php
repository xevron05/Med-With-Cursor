<?php //require "../php-config/Connection.php" ?>
<?php require "../controller/user-data.php";
//print_r($row);
$name = explode(" ", $row['FULLNAME']);

 ?>

<?php //require "../controller/Register-Controller.php" ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <link rel="stylesheet" href="../public/css/Register.css">

</head>
<body>
<div id="registration-container">
    <div class="login-logo">
        <img src="../public/images/login-logo.png" width="80" alt="Logo">
    </div>
    <h2 style="color: #3468C0;">Register</h2>
    <form action="../controller/user-update.php" method="post" enctype="multipart/form-data">
        <label>
            <input type="text" name="fname" value="<?php echo $name[0]; ?>" placeholder="First Name" required>
        </label>
        <label>
            <input type="text" name="lname"  value="<?php echo $name[1]; ?>" placeholder="Last Name" required>
        </label>
        <label>
            <input type="text" name="uname" value="<?php echo $row['USERNAME']; ?>" placeholder="Username" required>
        </label>

        <!-- Password input with toggle button -->
        <div class="password-container">
            <label for="password"></label><input type="password" value="<?php echo $row['PASSWORD']; ?>" name="password" id="password" placeholder="Password" required>
            <span class="password-toggle" onclick="togglePassword()">👁️</span>
        </div>

        <label>
            <input type="tel" name="phone" value="<?php echo $row['PHONENUMBER']; ?>" placeholder="Phone" required>
        </label>
        <label>
            <input type="email" name="email" value="<?php echo $row['EMAIL']; ?>" placeholder="Email" required>
        </label>

        <label for="gender">Gender:</label>
        <select  id="gender" name="gender" required>
            <option value="" disabled selected>Select gender</option>
            <option value="male"
                    <?php if($row['GENDER'] == 'male'){
                    echo "selected";
                }
                ?>
            >
                Male</option>
            <option value="female"
                <?php if($row['GENDER'] == 'female'){
                    echo "selected";
                }
                ?>
            >
                Female</option>
            <option value="other"
                <?php if($row['GENDER'] == 'other'){
                    echo "selected";
                }
                ?>
            >
                Other</option>
        </select>

        <label for="profile-picture">Profile Picture </label>
        <input type="file" value="<?php echo $row['PROFILEPICTURE']; ?>" id="prof-Img" name="prof-Img" placeholder="Select Profile Picture">
        <!--            <input type="submit" name="upload" Sid="upload" placeholder="upload">-->

        <button type="submit" >Register</button>
    </form>
    <script>
        function togglePassword() {
            let passwordInput = document.getElementById("password");
            let toggleButton = document.querySelector(".password-toggle");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.textContent = "🫣";
            } else {
                passwordInput.type = "password";
                toggleButton.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
