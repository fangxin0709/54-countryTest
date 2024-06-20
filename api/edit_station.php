<?php include_once "db.php";
$sql="UPDATE `station` SET `minute`='{$_POST['editSta_minute']}',`waiting`='{$_POST['edit_waiting']}' WHERE `id`='{$_POST['editStationID']}'";
$conn->exec($sql);
header("location:../admin.php");