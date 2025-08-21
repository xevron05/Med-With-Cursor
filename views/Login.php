<?php session_start();
//require ("../controller/isLogin.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../public/css/Login.css">
</head>
<body>
<div id="login-container" >
    <div class="login-logo">
        <img src="../public/images/login-logo.png" width="100" alt="Logo">
    </div>
    <h2 style="color: #3468C0;">Login</h2>

    <?php if (isset($_GET['notmatch']) == '1') {?>
<!--        <script>alert("Incorrect username or password.");</script>-->
        <p class="incorrect-color">Incorrect username and password!</p>
    <?php }?>
    <?php if (isset($_GET['registered']) == '1') {?>
        <!--        <script>alert("Incorrect username or password.");</script>-->
        <p class="registered-login">Register successful. Please Login</p>
    <?php }?>

    <?php if (isset($_GET['noaccount']) == '1') {?>
        <p class="incorrect-color">You don't have an account. <br> <a href="../views/Register.php">Create an account</a></p>
    <?php }?>
    <form action="../controller/login_process.php" method="post">

        <div class="password-container">
            <input type="text" name="username" placeholder="Username" required>
            <div class="password-toggle" onclick="togglePassword()">👁️</div>
        </div>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="./Register.php">Register here</a></p>
</div>

<script>
    function togglePassword() {
        let passwordInput = document.getElementById("password");
        let toggleButton = document.querySelector(".password-toggle");


        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButton.textContent = "🫣";

        } else {
            passwordInput.type = "password";
            toggleButton.textContent = "👀️";
        }
    }
</script>
</body>
</html>
