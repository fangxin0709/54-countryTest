<?php include "./api/db.php";
$sql="select `id`,`email` from `form`";
$get = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($get,JSON_UNESCAPED_UNICODE);