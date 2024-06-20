<?php include_once "db.php";
$check=$conn->query("select count(*) from `form` where `email`='{$_POST['email']}'")->fetchColumn();
if($check==1){
    ?>
    <script>
        alert("已有此參與者!");
        location.href='../admin.php';
    </script>
    <?php
}else{
    $sql="INSERT into `form`(email) values('{$_POST['email']}')";
    $conn->exec($sql);
    header("location:../admin.php");
}