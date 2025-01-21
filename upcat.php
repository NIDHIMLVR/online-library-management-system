<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    
    $query = "select * from category";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/admincat.css">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <title>Update category</title>
</head>
<body>
    <h1>Update category</h1>
    <form>
    <table class="box">
    <tr>
                            <th>Category id</th>
                            <th>Category name</th>
                            <th>Action</th>
                            
                        </tr>
                        <?php
                        $query_run = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                            <td><?php echo $row['cat_id'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><a href="edc.php?bn=<?php echo $row['cat_id'];?>">Edit</a></td>
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