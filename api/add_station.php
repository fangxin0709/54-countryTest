<?php include_once "db.php";
$query="select max(rank) as maxRank FROM `station`";
$row=$conn->query($query)->fetch(PDO::FETCH_ASSOC);
$newRank=$row['maxRank']+1;

$sql="INSERT INTO `station`(`stationName`, `minute`, `waiting`,`rank`) VALUES ('{$_POST['stationName']}','{$_POST['minute']}','{$_POST['waiting']}',$newRank)";
$conn->query($sql);
header("location:../admin.php");