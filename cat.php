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
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <link rel="stylesheet" href="login/admincat.css">
    <title>view category</title>
</head>
<body>
    <h1>View Category</h1>
    <form>
    <table>
    <tr>
                            <th>Category id</th>
                            <th>Category name</th>
                            
                        </tr>
                    <?php
                        $query_run = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                            <td><?php echo $row['cat_id'];?></td>
                            <td><?php echo $row['category_name'];?></td>
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

