<?php include "db.php";
if($_POST['needBus']=='0'){
    ?>
    <script>
        alert("目前無法派遣車輛!");
        location.href="../admin.php";
    </script>
    <?php
    exit();
}
$rows = $conn->query("select * from `form` where `checked` ='1' AND `close`='1'")->fetchAll(PDO::FETCH_ASSOC);
$allReses = count($rows);
$people = 3;
$needBus = ceil($allReses / $people);
for ($i = 0; $i < $allReses; $i++) {
    $busNum = sprintf("%04d", floor($i / $people) + 1); // 車輛編號
    $busName = "AUTO-" . $busNum;
    $personId = $rows[$i]['id'];
    $sql = "UPDATE `form` SET `takeBus` = '$busName' WHERE `id` = $personId";
    $conn->exec($sql);
}
$sql = "UPDATE `formopen` SET `active`='0' WHERE `id`=1;";
$conn->exec($sql);
$sql = "UPDATE `form` SET `close`='0' where `checked` = '1'";
$conn->exec($sql);
header("location:../admin.php");
?>