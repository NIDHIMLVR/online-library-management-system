<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $query = "delete from category where cat_id = $_GET[bn]";
    $query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
    alert("Category Deleted successfully...");
    window.location.href = "dcat.php";
</script>