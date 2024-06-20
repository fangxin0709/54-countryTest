<?php include_once "db.php";
session_start();
if($_SESSION['veri']!=$_POST['veri']){
    header("location:../login.php?error=1");
    exit();
}
$admin=$conn->query("SELECT count(*) 
                    FROM admin 
                    WHERE acc='{$_POST['acc']}' && `pw`='{$_POST['pw']}'")
            ->fetchColumn();
if($admin==1){
    $_SESSION['login']="ok";
    ?>
    <script>
          alert("登入成功!");
          location.href="../admin.php";
    </script>
    <?php
}else{
    header("location:../login.php?error=2");
}