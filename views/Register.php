<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="../public/css/Register.css">
</head>

<body>
    <div id="registration-container">
        <div class="login-logo">
            <img src="../public/images/login-logo.png" width="80" alt="Logo">
        </div>
        <h2 style="color: #3468C0;">Register</h2>
        <form action="../controller/Register-Controller.php" method="post" enctype="multipart/form-data">
            <label>
                <input type="text" name="fname" placeholder="First Name" required>
            </label>
            <label>
                <input type="text" name="lname" placeholder="Last Name" required>
            </label>
            <label>
                <input type="text" name="uname" placeholder="Username" required>
            </label>

            <!-- Password input with toggle button -->
            <div class="password-container">
                <label for="password"></label><input type="password" name="password" id="password" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePassword()">👁️</span>
            </div>

            <label>
                <input type="tel" name="phone" placeholder="Phone" required>
            </label>
            <label>
                <input type="email" name="email" placeholder="Email" required>
            </label>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="profile-picture">Profile Picture </label>
            <input type="file" id="prof-Img" name="prof-Img" placeholder="Select Profile Picture">
            <!--            <input type="submit" name="upload" Sid="upload" placeholder="upload">-->

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="Login.php">Login here</a></p>
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
                toggleButton.textContent = "👁️";
            }
        }
    </script>
</body>

</html>