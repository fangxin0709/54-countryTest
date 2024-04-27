<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台北101接駁系統</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/incn.png" type="image/x-icon">
</head>
<style>
    .btn-change{
        background-color: #eaeaea;
    }
    .btn-change.active{
        background-color: #d0cece;
        /* color: #0e3f62; */
    }
    .carousel-indicators{
        margin: 0;
        justify-content:flex-start;
        bottom: 85%;
        border: 2px solid #3875ab75;
        padding: 10px;
    }
    .table td{
        border: none;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #d3e0e584;
    }
    td:first-child{
        border-radius: 10px 0 0 10px ;
    }
    td:last-child{
        border-radius: 0px 10px 10px 0px ;
    }
    .carousel-item{
        /* overflow: scroll;
        overflow-x: hidden; */
        height: 600px;
        position: relative;
        top: 110px;
    }
</style>
<body>
<?php session_start();
if(!isset($_SESSION['login'])){
    ?>
    <script>
        alert("請先登入!");
        location.href="./login.php";
    </script>
    <?php
}
include 'nav.php';
?>
<main>
    <div id="Slider" class="container slide carousel">
        <div class="carousel-indicators">
            <div data-target="#Slider" data-slide-to="0" class="active btn btn-change m-1"><span>接駁車管理</span></div>
            <div data-target="#Slider" data-slide-to="1" class="btn btn-change m-1"><span>站點管理</span></div>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <table class="table table-striped">
                    <h1 class="text-center m-3">接駁車管理</h1>
                    <?php include_once "./api/db.php";
                    $rows = $conn -> query("select * from `bus`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rows as $row){
                        ?>
                        <tr style="background-color: #7aaacc;color: #fff;">
                            <td>編號</td>
                            <td>車牌</td>
                            <td>已行駛時間(分鐘)</td>
                            <td>新增時間</td>
                            <td>操作</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                        </tr>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['busName']?></td>
                            <td><?=$row['minute']?></td>
                            <td><?=$row['addTime']?></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="carousel-item">
                <table class="table table-striped">
                    <h1 class="text-center m-3">站點管理</h1>
                    <?php include_once "./api/db.php";
                    $rows = $conn -> query("select * from `station`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rows as $row){
                        ?>
                        <tr style="background-color: #7aaacc;color: #fff;">
                            <td>編號</td>
                            <td>站點名稱</td>
                            <td>行駛時間(分鐘)</td>
                            <td>停留時間(分鐘)</td>
                            <td>新增時間</td>
                            <td>操作</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                            <td style="padding: 0px !important;height: 7px;"></td>
                        </tr>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['stationName']?></td>
                            <td><?=$row['minute']?></td>
                            <td><?=$row['waiting']?></td>
                            <td><?=$row['addTime']?></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="./js/jquery-3.6.3.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script>
</script>
</html>