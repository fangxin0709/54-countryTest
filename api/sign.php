<?php include_once "db.php"; 
session_start();
if($_SESSION['signVeri']!=$_POST['signVeri']){
    header("location:../login.php?error=3");
    exit();
}else{
    $sql="INSERT into `admin`(`acc`,`pw`)VALUES('{$_POST['signAcc']}','{$_POST['signPw']}')";
    $conn->exec($sql);
    ?>
    <script>
          alert("註冊成功!");
          location.href="../login.php";
    </script>
    <?php
}
