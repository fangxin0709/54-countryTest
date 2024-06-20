<?php include_once "db.php";
$sql="UPDATE `bus` SET `minute`='{$_POST['editBus_minute']}' WHERE `id`='{$_POST['editBusID']}'";
$conn->exec($sql);
header("location:../admin.php");