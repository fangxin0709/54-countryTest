<?php include_once "db.php";
$sql="SELECT * FROM `{$_GET['table']}` WHERE `id`='{$_GET['id']}'";
$row=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);