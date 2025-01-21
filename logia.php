<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/logi.css">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <title>Admin login</title>
</head>
<body>
    <h1>Admin's Login</h1>
    <div>
    <form action="" method="POST"><br><br><label for="email"><b>Email ID:</b></label>
        <input type="text" name="email" required><br><br><br>
        <label for="password"><b>Password:</b></label>
        <input type="password" name="password" required><br><br><br>
        <button type=submit name="login">Login</button><br><br><br>
        
    </form>
    
<?php 
if(isset($_POST['login'])){
                   
                    $connection = mysqli_connect("localhost","root","");
                    $db = mysqli_select_db($connection,"lms");
            
                    $query = "select * from admin where email = '$_POST[email]'";
                    $query_run = mysqli_query($connection,$query);
                    $found = false; 
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $found = true;
                        if ($row['password'] === $_POST['password']) {
                            $_SESSION['email'] = $row['email'];
                            header("Location: adashboard.php");
                            exit();
                        } else {
                            // Wrong password message
                            echo '<br><br><center><span class="alert-danger">Wrong Password !!</span></center>';
                        }
                    }
                
                    if (!$found) {
                        // Email not registered
                        echo '<br><br><center><span class="alert-danger">Email not registered !!</span></center>';
                    }
                }
                ?>
</div>
</body>
</html>