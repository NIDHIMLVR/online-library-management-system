<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <link rel="stylesheet" href="login/adminf.css">
    <title>Add category</title>
</head>
<body>
<h1>Add Category</h1>
    <div class ="box">
    <form action="" method="POST"><br><br>
        <label for="categoryname"><b>Category Name:</b></label>
        <input type="text" name="categoryname" required><br><br><br>
        <button type=submit name="add">Add</button><br><br><br>

        </form>
    </div>
    
</body>
</html>
<?php
    if(isset($_POST['add']))
    {
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "insert into category values(null,'$_POST[categoryname]')";
        if (mysqli_query($connection, $query)) {
            // Book added successfully, trigger alert and redirect
            echo "
            <script type='text/javascript'>
                alert('Category added successfully...');
                window.location.href = 'adashboard.php';
            </script>
            ";
        } else {
            // Display error message
            echo "
            <script type='text/javascript'>
                alert('Error adding book: " . mysqli_error($connection) . "');
                window.location.href = 'addbooks.php';
            </script>
            ";
        }
    
        #header("location:add_book.php");
    }
?>