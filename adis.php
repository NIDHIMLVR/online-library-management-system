<?php
    session_start();
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $bookid = [];
    $readerid=[];
    $query1 = "select * from books";
    $query2="Select * from readers"; // Adjust the table name and columns as necessary
    $result = mysqli_query($connection, $query1);
    $result1=mysqli_query($connection, $query2);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookid[] = $row;
    }
}
if ($result1 && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $readerid[] = $row;
    }
}?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="login/books-bookstore-book-reading-159711_resized.jpg">
    <link rel="stylesheet" href="login/adminf.css">
    <title>Add issue</title>
</head>
<body>
<h1>Add Book Issues</h1>
    <div class="box1">
        <form action="" method="POST"><br><br><label for="bookid"><b>Book ID:</b></label>
        <select name="bookid" required>
            <option value="" disabled selected>Select a bookid</option>
            <?php foreach ($bookid as $books): ?>
                <option value="<?= $books['book_id']?>">  
                <?= $books['book_id'] ?>-<?= $books['title'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br><br>
        <label for="readerid"><b>Reader ID:</b></label>
        <select name="readerid" required>
            <option value="" disabled selected>Select a readerid</option>
            <?php foreach ($readerid as $readers): ?>
                <option value="<?= $readers['id']?>">  
                <?= $readers['id'] ?>-<?= $readers['Firstname'] ?>.<?= $readers['Lastname'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br><br>
        <label for="issuedate"><b>Enter a date:</b></label>
        <input type="date" name="issuedate" required><br><br><br>
        <button type=submit name="add">Add</button><br><br><br>
        
        </form>
    </div>
    
</body>
</html>
<?php
if (isset($_POST['add'])) {
    // Store the book_id from the form
    $bookId = $_POST['bookid'];

    // Fetch the book title and author based on the book_id
    $bookQuery = "SELECT title, authorname FROM books WHERE book_id = $bookId";
    $bookResult = mysqli_query($connection, $bookQuery);

    if ($bookResult && mysqli_num_rows($bookResult) > 0) {
        $bookData = mysqli_fetch_assoc($bookResult);
        $bookTitle = $bookData['title'];
        $bookAuthor = $bookData['authorname'];

        // Insert the data into the issuebook table
        $query = "INSERT INTO issuebook (book_id, book_title, book_author, reader_id, issue_date) 
                  VALUES ($bookId, '$bookTitle', '$bookAuthor', $_POST[readerid], '$_POST[issuedate]')";

        if (mysqli_query($connection, $query)) {
            echo "
            <script type='text/javascript'>
                alert('Book issue added successfully...');
                window.location.href = 'bi.php';
            </script>
            ";
        } else {
            echo "
            <script type='text/javascript'>
                alert('Error adding book issue: " . mysqli_error($connection) . "');
                window.location.href = 'adis.php';
            </script>
            ";
        }
    } else {
        echo "
        <script type='text/javascript'>
            alert('Error: Book not found.');
            window.location.href = 'adis.php';
        </script>
        ";
    }
}
?>