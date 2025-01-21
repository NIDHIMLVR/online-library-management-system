<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/dashboardstyle.css">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <title>Admin's dashboard</title>
</head>
<body>
    <header>
    <div class="nav">
        <?php echo $_SESSION['email'];?>
        <a class="btn"><input name="newThread" type="button" value="Log out" onclick="location.href='logout.php';"/></a>
    </div>
    </header>
    <h1>Admin's Dashboard</h1>
    <div>
        <a class="box1"><input name="newThread" type="button" value="Add books" onclick="location.href='addbooks.php';"/></a>
        <a class="box2"><input name="newThread" type="button" value="Update books" onclick="location.href='adu.php';"/></a>
        <a class="box3"><input name="newThread" type="button" value="Manage Books issue" onclick="location.href='bi.php';"/></a>
        <a class="box4"><input name="newThread" type="button" value="Delete books" onclick="location.href='db.php';"/></a>
        <a class="box5"><input name="newThread" type="button" value="View categories" onclick="location.href='cat.php';"/></a>
        <a class="box6"><input name="newThread" type="button" value="Add categories" onclick="location.href='addcat.php';"/></a>
        <a class="box7"><input name="newThread" type="button" value="Manage categories" onclick="location.href='upcat.php';"/></a>
        <a class="box8"><input name="newThread" type="button" value="Delete categories" onclick="location.href='dcat.php';"/></a>
        
    </div>

</body>
</html>