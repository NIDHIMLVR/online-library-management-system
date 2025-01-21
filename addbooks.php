<?php
    session_start();
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $categories = [];
    $query1 = "select * from category"; // Adjust the table name and columns as necessary
    $result = mysqli_query($connection, $query1);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <link rel="stylesheet" href="login/adminf.css">
    <title>Add books</title>
</head>
<body>
    <h1>Add Books</h1>
    <div>
        <form action="" method="POST"><br><br><label for="title"><b>Title:</b></label>
        <input type="text" name="title" required><br><br><br>
        <label for="authorname"><b>Author Name:</b></label>
        <input type="text" name="authorname" required><br><br><br>
        <label for="cost"><b>Cost per book:</b></label>
        <input type="text" name="cost" required><br><br><br>
        <label for="quantity"><b>Quantity:</b></label>
        <input type="text" name="quantity" required><br><br><br>
        <label for="catid"><b>Category:</b></label>
        <select name="catid" required>
            <option value="" disabled selected>Select a category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['cat_id']?>">
                    <?= $category['category_name'] ?> - <?= $category['cat_id'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br><br>
        <button type=submit name="add">Add</button><br><br><br>

        </form>
    </div>

</body>
</html>
<?php
    if(isset($_POST['add']))
    {
        
        $query = "insert into books values(null,'$_POST[title]','$_POST[authorname]','$_POST[cost]',$_POST[quantity],$_POST[catid])";
        if (mysqli_query($connection, $query)) {
            // Book added successfully, trigger alert and redirect
            echo "
            <script type='text/javascript'>
                alert('Book added successfully...');
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
