<?php include_once "db.php";
$sql="INSERT INTO `station`(`stationName`, `minute`, `waiting`) VALUES ('{$_POST['stationName']}','{$_POST['minute']}','{$_POST['waiting']}')";
$conn->query($sql);
header("location:../admin.php");