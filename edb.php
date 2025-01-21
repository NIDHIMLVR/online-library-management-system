<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $book_id = "";
    $title = "";
    $authorname = "";
    $cost = "";
    $quantity = "";
    $cat_id = "";
    
    $query = "select * from books where book_id = $_GET[bn]";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $book_id= $row['book_id'];
        $title = $row['title'];
        $authorname = $row['authorname'];
        $cost = $row['cost'];
        $quantity = $row['quantity'];
        $cat_id = $row['cat_id'];
       
    $categories = [];
    $query1 = "select * from category"; // Adjust the table name and columns as necessary
    $result = mysqli_query($connection, $query1);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}
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
<h2>Edit Book</h2>
    <form action="" method="POST">
        <label for="title"><b>Title:</b></label>
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required><br><br>
        
        <label for="authorname"><b>Author Name:</b></label>
        <input type="text" name="authorname" value="<?= htmlspecialchars($authorname) ?>" required><br><br>
        
        <label for="cost"><b>Cost:</b></label>
        <input type="text" name="cost" value="<?= htmlspecialchars($cost) ?>" required><br><br>
        
        <label for="quantity"><b>Quantity:</b></label>
        <input type="text" name="quantity" value="<?= htmlspecialchars($quantity) ?>" required><br><br>
        
        <label for="catid"><b>Category:</b></label>
        <select name="catid" required>
            <option value="" disabled>Select a category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['cat_id'] ?>" <?= $category['cat_id'] == $cat_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['category_name']) ?> - <?= $category['cat_id'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        
        <button type="submit" name="edit">Edit</button>
    </form>
    
</body>
</html>
<?php
    if(isset($_POST['edit'])){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "update books set title = '$_POST[title]',authorname ='$_POST[authorname]',cost = '$_POST[cost]',quantity = '$_POST[quantity]',cat_id ='$_POST[catid]' where book_id = $_GET[bn]";
        if (mysqli_query($connection, $query)) {
            // Book added successfully, trigger alert and redirect
            echo "
            <script type='text/javascript'>
                alert('Book updated successfully...');
                window.location.href = 'adu.php';
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

    