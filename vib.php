<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $issue_id = "";
    $book_id = "";
    $book_title= "";
    $book_author= "";
    $issue_date= "";
    
    $query = "select issue_id,book_id,book_title,book_author,issue_date,reader_id from issuebook where reader_id = $_SESSION[id] ";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <link rel="stylesheet" href="login/admincat.css">
<header>
    
        <div class="firstname"><?php echo $_SESSION['Firstname'];?></div>
        <div class="email"><?php echo $_SESSION['email'];?></div>
        <a class="btn2"><input name="newThread" type="button" value="Log out" onclick="location.href='logout.php';"/></a>
    
</header>
    <title>View Issue Book</title>
</head>
<body>
<h1 class=isus>View Issuebook</h1>
    <form>
    <table>
    <tr>
    <th>Issue id</th>
                            <th>Book id</th>
                            <th>Book title</th>
                            <th>Author name</th>
                            <th>Reader id</th>
                            <th>Issue date</th>
                            <th>Return date</th>
                            <th>Fine</th>
                            
                            
                        </tr>
                
                    <?php
                        $query_run = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                            <td><?php echo $row['issue_id'];?></td>
                            <td><?php echo $row['book_id'];?></td>
                            <td><?php echo $row['book_title'];?></td>
                            <td><?php echo $row['book_author'];?></td>
                            <td><?php echo $row['reader_id'];?></td>
                            <td><?php echo $row['issue_date'];?></td>
                            <td>
                    <?php
                    // Calculate the return date dynamically
                    $issue_date = $row['issue_date'];
                    $return_date = date('Y-m-d', strtotime($issue_date . ' + 7 days'));
                    echo $return_date;
                    ?>
                      </td>
                      <td>
                    <?php
                    // Calculate the fine dynamically
                    $current_date = date("Y-m-d"); // Get today's date
                    if ($current_date > $return_date) {
                        // Calculate the number of days overdue
                        $days_overdue = (strtotime($current_date) - strtotime($return_date)) / (60 * 60 * 24);
                        $fine = $days_overdue * 100; // Fine is 100 per day
                    } else {
                        $fine = 0; // No fine if the book is not overdue
                    }
                    echo "Fine: ₹" . $fine;
                    ?>
                </td>
                            <?php
                        }
                    ?>  
                        </tr>
    </table>
    <br><br><br>
    <a class="btn"><input name="newThread" type="button" value="Done" onclick="window.open('userdashboard.php')"/></a>
    </form>
    
</body>

</body>
</html>