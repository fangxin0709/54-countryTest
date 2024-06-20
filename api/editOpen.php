<?php include_once "db.php";
    $sql = "UPDATE `formopen` SET `active`='{$_POST['active']}' WHERE `id`=1;";
    $conn->exec($sql);
?>