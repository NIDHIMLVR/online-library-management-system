<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <title>Searchbooks</title>
    <link rel="stylesheet" href="login\seabook.css">
</head>
<header>
<div class="firstname"><?php echo $_SESSION['Firstname'];?></div>
<div class="email"><?php echo $_SESSION['email'];?></div>
<a class="btn2"><input name="newThread" type="button" value="Log out" onclick="location.href='logout.php';"/></a>
</header>
<body>
<h1>Search Books</h1>
    <div class="content">
    <form action="" method="POST"><br><br><label for="bookname"><b>Book Name:</b></label>
        <input type="text" name="bookname" required><br><br><br>
        <label for="bookauthor"><b>Book author:</b></label>
        <input type="text" name="Bookauthor" required><br><br><br>
        <button type=submit name="search">Search</button><br><br><br>
</div>    
    </form>
<?php 
                if(isset($_POST['search'])){
                    $connection = mysqli_connect("localhost","root","");
                    $db = mysqli_select_db($connection,"lms");
                    $query = "select * from books where title ='$_POST[bookname]'";
                    $query_run = mysqli_query($connection,$query);
                    $found = false; 
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $found = true; 
                        if ($row['authorname'] === $_POST['Bookauthor']) {
                            ?>
                            <table class="box">
                            <tr>
                            <th>Book id</th>
                            <th>Title</th>
                            <th>Author name</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Category id</th>
                        </tr>
                            <tr>
                            <td><?php echo $row['book_id'];?></td>
                            <td><?php echo $row['title'];?></td>
                            <td><?php echo $row['authorname'];?></td>
                            <td><?php echo $row['cost'];?></td>
                            <td><?php echo $row['quantity'];?></td>
                            <td><?php echo $row['cat_id'];?></td>
                            </tr>
                            
                            <?php
                        } 
                        else {
            
                               echo '<br><br><center><span class="alert-danger">Book not found !!</span></center>';
                                 }
                                 }

                          if (!$found) {

                             echo '<br><br><center><span class="alert-danger">No book found with booktitle and authorname !!</span></center>';
}
}
?>
                        
    </table>
    <br><br><br>
    <a class="btn3"><input name="newThread" type="button" value="Done" onclick="window.open('userdashboard.php')"/></a>

</div>
</body>
</html>