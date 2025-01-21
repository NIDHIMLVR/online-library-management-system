<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $query = "insert into readers values('','$_POST[Firstname]','$_POST[Lastname]','$_POST[email]','$_POST[password]',$_POST[mobile])";
    $query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
    alert("Registration successfull...You may Login now !!");
    window.location.href = "logi.php";
</script>