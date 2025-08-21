<?php session_start();?>
<?php require "../controller/isLogin.php"?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Need Helps?</title>
    <link rel="stylesheet" href="../public/css/NeedHelps.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<div class="container">
<body>
<header>
    <h1>Need Help</h1>
</header>


<div class="contactAdmin">
    <div class="contactMethod">
        <i class="fas fa-globe"></i>
        <h3>Website</h3>
        <p>www.medsoft.com</p>
    </div>
    <div class="contactMethod">
        <i class="fas fa-phone"></i>
        <h3>Call Us</h3>
        <p>9848744205</p>
    </div>
    <div class="contactMethod">
        <i class="fas fa-envelope"></i>
        <h3>Email Us</h3>
        <p>medsoft@gmail.com</p>
    </div>
    <div class="contactMethod">
        <i class="fas fa-clock"></i>
        <h3>Open Hour</h3>
        <p>Sunday - Friday</p>
        <p>9:00AM - 05:00PM</p>
    </div>
</div>

<section class="queries-box">
    <h2>Submit Your Query</h2>
    <form>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" required>

        <label for="problem">Problem</label>
        <textarea id="problem" name="problem" rows="4" required></textarea>

        <div class="btn-container">
            <input type="button" onclick="history.back()" value="Back">
            <input type="submit" value="Submit">

        </div>

    </form>
</section>
</div>
<br>
<footer class="Footer">
    &copy;copyright <b>MEDSOFT</b>. All Rights Reserved <br> Design by 💙 <b>medsoft</b>
</footer>
</body>

</html>
