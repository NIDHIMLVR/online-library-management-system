<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/logi.css">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <title>Readers Login</title>
</head>
<body>
    
    <h1>Reader's Login</h1>
    <div>
    <form action="" method="POST"><br><br><label for="email"><b>Email ID:</b></label>
        <input type="text" name="email" required><br><br><br>
        <label for="password"><b>Password:</b></label>
        <input type="password" name="password" required><br><br><br>
        <button type=submit name="login">Login</button><br><br><br>
        <p>Don't have an account? Signup.</p>
    </form>
    <?php 
                if(isset($_POST['login'])){
                    $connection = mysqli_connect("localhost","root","");
                    $db = mysqli_select_db($connection,"lms");
                    $query = "select * from readers where email = '$_POST[email]'";
                    $query_run = mysqli_query($connection,$query);
                
                    $found = false; // To check if any email matches

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $found = true; // Email found in the database
                        if ($row['password'] === $_POST['password']) {
            // Successful login
                        $_SESSION['Firstname'] = $row['Firstname'];
                        $_SESSION['Laststname'] = $row['Lastname'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['id'] = $row['id'];
                        header("Location: userdashboard.php");
                        exit();
                    } else {
            
                        echo '<br><br><center><span class="alert-danger">Wrong Password !!</span></center>';
                     }
                }

                    if (!$found) {
        
                        echo '<br><br><center><span class="alert-danger">Email not registered !!</span></center>';
    }
}
?>
    </div>
</body>
</html>