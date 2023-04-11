<?php
    require 'db_connect.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="Your first name" required>
        <br>
        <input type="text" name="reg_lname" placeholder="Your last name" required>
        <br>
        <input type="text" name="reg_username" placeholder="Your desired username" required>
        <br>
        <input type="email" name="reg_email" placeholder="Your email" required>
        <br>
        <input type="password" name="reg_pass" placeholder="Your password"  required>
        <br>
        <input type="password" name="reg_con_pass" placeholder="Confirm password"  required>
        <br>
        <input type="submit" name="register_button" value="Register now!" >
    </form>
    </center>
</body>
</html>