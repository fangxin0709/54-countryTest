<?php include_once "db.php";
$sql="DELETE FROM `bus` WHERE `id`='{$_POST['id']}'";
$conn->exec($sql);
header("location:../admin.php");