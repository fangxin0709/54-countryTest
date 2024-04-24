<?php include_once "db.php";
$sql="UPDATE `station` SET `minute`='{$_POST['minute']}','waiting'='{$_POST['waiting']}' WHERE `id`='{$_POST['id']}'";
$conn->exec($sql);
header("location:../admin.php");