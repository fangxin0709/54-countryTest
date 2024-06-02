<?php include_once "db.php";
$sql="SELECT * FROM `bus` WHERE `id`='{$_GET['id']}'";
$bus=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
echo json_encode($bus);