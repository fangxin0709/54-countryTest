<?php include_once "db.php";
$_SESSION['active'] = 'ok';
     $formOpen = $conn->query("select * from `formopen` where `id`=1;")->fetch(PDO::FETCH_ASSOC);
     if($formOpen['active']=='1'){
         $_SESSION['active'] = 'ok';
     }else{
         unset($_SESSION['active']);
     }
     if(!isset($_SESSION['active'])){
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
}else if($checkE==1 && $check== 1){
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