<?php include_once "db.php";
session_start();
if($_SESSION['veri']!=$_POST['veri']){
    header("location:../login.php?error=1");
    exit();
}
if($_POST['acc']=="admin" && $_POST['pw']=="1234"){
    $_SESSION['login']="ok";
    ?>
    <script>
        alert("登入成功!");
        location.href="../admin.php";
        </script>
    <?php
}else{
    header("location:../login.php?error=2");
    exit();
}