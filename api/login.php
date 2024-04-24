<?php include_once "db.php";
session_start();
if($_SESSION['veri']!=$_POST['veri']){
    header("location:../login.php?error=1");
    exit();
}
if($_POST['acc']=="admin" && $_POST['pw']=="1234"){
    ?>
    <script>
        alert("登入成功!");
    </script>
    <?php
    $_SESSION['login']=="ok";
    header("location:../admin.php");
}else{
    header("location:../login.php?error=2");
    exit();
}