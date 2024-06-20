<?php include_once "db.php";
    $sql = "UPDATE `indexVal` SET `editVal`='{$_POST['editVal']}' WHERE `id`=1;";
    $conn->exec($sql);
    ?>
    <script>
        alert("已更改!");
        location.href="index.php";
    </script>