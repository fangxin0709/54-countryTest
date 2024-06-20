<?php include_once "db.php";
$sql="SELECT * FROM `form` WHERE `id`='{$_GET['id']}'";
$forms=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
echo json_encode($forms,JSON_UNESCAPED_UNICODE);