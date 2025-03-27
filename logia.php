<?php
session_start();
$connection = new mysqli("localhost", "root", "", "lms");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Initialize login attempts if not set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Brute Force Protection: Lock out after 3 failed attempts
if ($_SESSION['login_attempts'] >= 3) {
    echo '<br><br><center><span class="alert-danger">Too many failed attempts! Try again later.</span></center>';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo '<br><br><center><span class="alert-danger">Please enter both email and password.</span></center>';
        exit();
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT email, password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // DIRECT COMPARISON since passwords are stored in plaintext
        if ($password === $row['password']) {
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION['email'] = $row['email'];
            $_SESSION['login_attempts'] = 0; // Reset login attempts after success

            header("Location: adashboard.php");
            exit();
        } else {
            $_SESSION['login_attempts']++; // Increase failed attempt counter
            echo '<br><br><center><span class="alert-danger">Wrong Password!</span></center>';
        }
    } else {
        $_SESSION['login_attempts']++;
        echo '<br><br><center><span class="alert-danger">Email not registered!</span></center>';
    }

    $stmt->close();
}

$connection->close();
?>

<!DOCTYPE html>
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
    

</div>
</body>
</html>