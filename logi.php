<?php
session_start();

// Database connection
$connection = new mysqli("localhost", "root", "", "lms");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo '<br><br><center><span class="alert-danger">Please enter both email and password.</span></center>';
    } else {
        // Use prepared statement
        $stmt = $connection->prepare("SELECT id, Firstname, Lastname, email, password FROM readers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if ($password === $row['password']) {  // Direct text comparison
                // Successful login
                $_SESSION['Firstname'] = $row['Firstname'];
                $_SESSION['Lastname'] = $row['Lastname']; // Fixed spelling
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];

                header("Location: userdashboard.php");
                exit();
            } else {
                echo '<br><br><center><span class="alert-danger">Wrong Password!</span></center>';
            }
        } else {
            echo '<br><br><center><span class="alert-danger">Email not registered!</span></center>';
        }

        $stmt->close();
    }
}

$connection->close();
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
    
    </div>
</body>
</html>