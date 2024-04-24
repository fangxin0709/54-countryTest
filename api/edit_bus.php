<?php include_once "db.php";
$sql="UPDATE `bus` SET `minute`='{$_POST['minute']}' WHERE `id`='{$_POST['id']}'";
$conn->exec($sql);
header("location:../admin.php");