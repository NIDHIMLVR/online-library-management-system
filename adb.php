<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $query = "delete from books where book_id = $_GET[bn]";
    $query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
    alert("Book Deleted successfully...");
    window.location.href = "db.php";
</script>