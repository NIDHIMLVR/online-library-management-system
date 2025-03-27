<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $cat_id="";
    $category_name = "";
    
    if (isset($_GET['bn']) && is_numeric($_GET['bn'])) {
        $cat_id = "";
        $category_name = "";
    
        // Use prepared statements to fetch data securely
        $stmt = $connection->prepare("SELECT cat_id, category_name FROM category WHERE cat_id = ?");
        $stmt->bind_param("i", $_GET['bn']);  // Binding `bn` as an integer
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            $cat_id = $row['cat_id'];
            $category_name = $row['category_name'];
        }
    
        $stmt->close(); // Close the statement
    } else {
        echo "Invalid category ID.";
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
    if(isset($_POST['edit']) && isset($_POST['categoryname']) && isset($_GET['bn']) && is_numeric($_GET['bn'])) {
        // Establish a database connection
        $connection = mysqli_connect("localhost", "root", "", "lms");
    
        // Prepare a secure SQL query
        $stmt = $connection->prepare("UPDATE category SET category_name = ? WHERE cat_id = ?");
        $stmt->bind_param("si", $_POST['categoryname'], $_GET['bn']);  // Binding `categoryname` as a string, `bn` as an integer
    
        if ($stmt->execute()) {
            echo "
            <script type='text/javascript'>
                alert('Category updated successfully...');
                window.location.href = 'upcat.php';
            </script>
            ";
        } else {
            echo "
            <script type='text/javascript'>
                alert('Error updating category: " . $stmt->error . "');
                window.location.href = 'addbooks.php';
            </script>
            ";
        }
    
        $stmt->close();
        mysqli_close($connection);
    }
    ?>
    