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
include "db.php";

// Get the number of people per bus
$num = $conn->query("select `people` from `people` limit 1")->fetchColumn();

// Get the total number of users who meet the criteria
$total_users = $conn->query("select count(*) from `form` where `checked`='1' AND `close`='1'")->fetchColumn();

// Calculate the number of buses needed
$counts = ceil($total_users / $num);

// Get the users who meet the criteria
$users = $conn->query("select * from `form` where `checked`='1' AND `close`='1'")->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < $counts; $i++) {
    $bus_num = "AUTO-" . sprintf("%04d", rand(1, 9999));
    $start = $i * $num;
    $end = $start + $num;

    for ($j = $start; $j < $end && $j < $total_users; $j++) {
        $user = $users[$j];
        $sql = "update `form` set `takeBus`='$bus_num' where `id`='{$user['id']}'";
        $conn->exec($sql);
    }
}
$sql = "UPDATE `formopen` SET `active`='0' WHERE `id`='1'";
$conn->exec($sql);
$sql = "UPDATE `form` SET `close`='0' where `checked` = '1'";
$conn->exec($sql);
?>
<script>
alert("已分配車輛!");
location.href='../admin.php';
</script>