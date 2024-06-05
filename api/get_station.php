<?php include_once "db.php";
$sql="SELECT * FROM `station` WHERE `id`='{$_GET['id']}'";
$stations=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
echo json_encode($stations,JSON_UNESCAPED_UNICODE);