<?php include_once "db.php";
$sql="DELETE FROM `form` WHERE `id`='{$_POST['id']}'";
$conn->exec($sql);
header("location:../admin.php");