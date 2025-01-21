<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $query = "delete from issuebook where issue_id = $_GET[bn]";
    $query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
    alert("Issue history Deleted successfully...");
    window.location.href = "bi.php";
</script>