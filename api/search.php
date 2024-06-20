<?php include "db.php";
$checkE=$conn->query("SELECT count(*) FROM `form` WHERE `email`='{$_POST['email']}'")->fetchColumn();
$checkBus=$conn->query("select `takeBus` from `form` where `email`='{$_POST['email']}'")->fetch();
$checkN=$conn->query("select `name` from `form` where `email`='{$_POST['email']}'")->fetch();
$checkBus1 = !empty($checkBus['takeBus']) ? 1 : 0;
$checkN1 = !empty($checkN['name']) ? 1 : 0;
if($checkE == 1 && $checkBus1 == 1 && $checkN1 ==1){
    ?>
    <script>
        alert("您的接駁車是:<?=$checkBus['takeBus']?>");
        location.href="../search.php";
    </script>
    <?php
    exit();
}else if($checkE ==1 && $checkBus1 ==0 && $checkN1== 1){
    ?>
    <script>
        alert("目前尚未分配接駁車");
        location.href="../search.php";
    </script>
    <?php
}else if($checkE==1 && $checkN1 ==0){
    ?>
    <script>
        alert("您還沒填寫意願調查表單");
        location.href="../search.php";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("您不在參與者名單中");
        location.href="../search.php";
    </script>
    <?php
}
