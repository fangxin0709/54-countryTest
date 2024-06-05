<?php include_once "db.php";
if($_POST['editSta_minute'] >=0 && $_POST['edit_waiting'] >=0){
    $sql="UPDATE `station` SET `minute`='{$_POST['editSta_minute']}',`waiting`='{$_POST['edit_waiting']}' WHERE `id`='{$_POST['editStationID']}'";
    $conn->exec($sql);
    ?>
        <script>
            alert('已修改');
            location.href='../admin.php';
            </script>
    <?php
}else{
    ?>
    <script>
        alert('值必須大於等於0,請重新修改');
        location.href='../admin.php';
        </script>
        <?php
}
?>