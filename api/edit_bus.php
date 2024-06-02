<?php include_once "db.php";
if($_POST['editBus_minute']<=0){
    ?>
    <script>
        alert("值必須大於0,請重新修改");
        location.href='../admin.php';
    </script>
    <?php
}else{
    $sql="UPDATE `bus` SET `minute`='{$_POST['editBus_minute']}' WHERE `id`='{$_POST['editBusID']}'";
    $conn->exec($sql);
    header("location:../admin.php");
}