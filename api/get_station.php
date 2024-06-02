<?php include_once "db.php";
$sql="SELECT * FROM `station` WHERE `id`='{$_GET['id']}'";
$station=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
echo json_encode($station);