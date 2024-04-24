<?php include_once "db.php";
$sql="SELECT * FROM `bus` WHERE `id`";
$row=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);