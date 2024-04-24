<?php include_once "db.php";
$sql="INSERT INTO `bus`(`busName`, `minute`) VALUES ('{$_POST['busName']}','{$_POST['minute']}')";
$conn->query($sql);
header("location:../admin.php");