<?php include_once "./api/db.php";
    $div = $_POST['editVal'];
    $sql = "UPDATE `indexVal` SET `editVal`='{$_POST['editVal']}' WHERE `id`=1;";
    $conn->query($sql);
    ?>
    <script>
        alert("已更改!");
        location.href="index.php";
    </script>
    <?php
?>