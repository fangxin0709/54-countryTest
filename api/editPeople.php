<?php include_once "db.php";
    $sql = "UPDATE `people` SET `people`='{$_POST['people']}' WHERE `id`=1;";
    $conn->exec($sql);
    ?>
    <script>
        alert("已更改!");
        location.href="../admin.php";
    </script>