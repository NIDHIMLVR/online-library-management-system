<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    
    $query = "select * from books";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/admincat.css">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <title>Delete book</title>
</head>
<body>
<h1>Delete books</h1>
    <form>
    <table class="box">
    <tr>
                            <th>Book id</th>
                            <th>Title</th>
                            <th>Author name</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Category id</th>
                            <th>Action</th>
                            
                        </tr>
                        <?php
                        $query_run = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                            <td><?php echo $row['book_id'];?></td>
                            <td><?php echo $row['title'];?></td>
                            
                            <td><?php echo $row['authorname'];?></td>
                            <td><?php echo $row['cost'];?></td>
                            <td><?php echo $row['quantity'];?></td>
                            <td><?php echo $row['cat_id'];?></td>
                            <td><a href="adb.php?bn=<?php echo $row['book_id'];?>">Delete</a></td>
                            <?php
                        }
                    ?>  
                        </tr>
    </table>
    <br><br><br>
    <a class="btn"><input name="newThread" type="button" value="Done" onclick="window.open('adashboard.php')"/></a>
    </form>
</body>
</html>