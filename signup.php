<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/signstyle.css">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <title>signup</title>
</head>
<body>
    <h1>Sign Up</h1>
    <div><form action="register.php" method="POST"><br><br><label for="Firstname"><b>Firstname:</b></label>
        <input type="text" name="Firstname" required><br><br><br>
        <label for="Lastname"><b>Lastname:</b></label>
        <input type="text" name="Lastname" required><br><br><br>
        <label for="email"><b>Email:</b></label>
        <input type="text" name="email" required><br><br><br>
        <label for="password"><b>Password:</b></label>
        <input type="text" name="password" required><br><br><br>
        <label for="mobile"><b>Mobile:</b></label>
        <input type="text" name="mobile" required><br><br><br>
        <button type=submit name="Signup">Sign up</button><br><br><br>
        
    </form>
    
</div>
</body>
</html>