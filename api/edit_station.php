<?php include_once "db.php";
if($_POST['editSta_minute'] || $_POST['edit_waiting'] <=0){
    ?>
    <script>
        alert('值必須大於0,請重新修改');
        location.href='../admin.php';
    </script>
    <?php
}else{
    $sql="UPDATE `station` SET `minute`='{$_POST['editSta_minute']}',`waiting`='{$_POST['edit_waiting']}' WHERE `id`='{$_POST['editStationID']}'";
    $conn->exec($sql);
    header("location:../admin.php");
}