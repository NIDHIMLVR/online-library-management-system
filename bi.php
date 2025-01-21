<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    
    $query = "select * from issuebook";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <link rel="stylesheet" href="login/admincat.css">
    <title>Manage book issue</title>
</head>
<body>
<h1>View Book Issue</h1>
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
                            <th>Action</th>  
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
                            <td><a href="adi.php?bn=<?php echo $row['issue_id'];?>">Delete</a></td> 
                            <?php
                        }
                    ?>  
                        </tr>
    </table>
    <br><br><br>
    <a class="btn"><input name="newThread" type="button" value="Add" onclick="window.open('adis.php')"/></a>
    <a class="btn1"><input name="newThread" type="button" value="Done" onclick="window.open('adashboard.php')"/></a>
    </form>
</body>
</html>