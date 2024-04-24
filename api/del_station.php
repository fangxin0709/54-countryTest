<?php include_once "db.php";
$sql="DELETE FROM `station` WHERE `id`='{$_POST['id']}'";
$conn->exec($sql);
header("location:../admin.php");