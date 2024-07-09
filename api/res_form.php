<?php include_once "db.php";
     $formOpen = $conn->query("select `active` from `formopen` limit 1")->fetchColumn();
     if($formOpen==0){
        ?>
        <script>
            alert("該表單目前不接受回應!");
            location.href = "../index.php";
        </script>
    <?php
    exit();
    }
$checkE=$conn->query("SELECT count(*) FROM `form` WHERE `email`='{$_POST['email']}'")->fetchColumn();
$check=$conn->query("select `checked` from `form` where `email`='{$_POST['email']}'")->fetchColumn();
if($checkE==1 && $check == 0){  
    $sql="update `form` set `name`='{$_POST['name']}',`checked`='1' where `email`='{$_POST['email']}'";
    $conn->exec($sql);
    ?>
    <script>
        alert("謝謝您的填寫!");
        location.href = "../index.php";
    </script>
<?php
}else if($check== 1){
    ?>
    <script>
        alert("您已經參與過意見調查!");
        location.href = "../index.php";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("您不在參與者名單中!");
        location.href = "../form.php";
    </script>
    <?php
}