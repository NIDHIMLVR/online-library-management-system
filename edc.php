<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $cat_id="";
    $category_name = "";
    $query = "select * from category where cat_id = $_GET[bn]";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $cat_id= $row['cat_id'];
        $category_name = $row['category_name'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <link rel="stylesheet" href="login/adminf.css">
    <title>edit</title>

</head>
<body>
    <h2>Edit</h2>
        <form action="" method="POST"><br><br>
        <label for="categoryname"><b>Category name:</b></label>
        <input type="text" name="categoryname" required><br><br><br>
        <button type=submit name="edit">Edit</button><br><br><br>
 </form>
 </body>
</html>
<?php
    if(isset($_POST['edit'])){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "update category set category_name =' $_POST[categoryname]' where cat_id = $_GET[bn]";
        if (mysqli_query($connection, $query)) {
            // Book added successfully, trigger alert and redirect
            echo "
            <script type='text/javascript'>
                alert('category updated successfully...');
                window.location.href = 'upcat.php';
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
    }
    ?>
    