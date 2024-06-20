<?php include_once "db.php";
$sql="UPDATE `form` SET `name`='{$_POST['name']}' WHERE `id`='{$_POST['editFormID']}'";
$conn->exec($sql);
header("location:../admin.php");