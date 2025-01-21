<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User dashboard</title>
    <link rel="stylesheet" href="login/dashboardstyle.css">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
</head>
<body>
<header>
<div class="nav">
        <span class="firstname"><?php echo $_SESSION['Firstname'];?></span>
        <span class="email"><?php echo $_SESSION['email'];?></span>
        <a class="btn"><input name="newThread" type="button" value="Log out" onclick="location.href='logout.php';"/></a>
    </div>
</header>
    <h1>User dashboard</h1>
    <div>
        <a class="box3"><input name="newThread" type="button" value="Search Books" onclick="location.href='sebooks.php';"/></a>
        <a class="box4"><input name="newThread" type="button" value="View Issued Book " onclick="location.href='vib.php';"/></a>
    </div>
</body>
</html>