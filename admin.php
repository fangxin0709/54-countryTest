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
    body{
        background-color:hsl(0, 0%, 100%);
    }
    .btn-change {
        background-color: #eaeaea;
    }

    .btn-change.active {
        background-color: #d0cece;
        /* color: #0e3f62; */
    }

    .carousel-indicators {
        margin: 0;
        justify-content: flex-start;
        bottom: 90%;
        border: 2px solid #3875ab75;
        padding: 10px;
    }

    .table td {
        border: none;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #d3e0e584;
    }

    td:first-child {
        border-radius: 10px 0 0 10px;
    }

    td:last-child {
        border-radius: 0px 10px 10px 0px;
    }

    .carousel-item {
        height: 1200px;
        position: relative;
        top: 110px;
    }

    table {
        border-collapse: separate;
        border-spacing: 0 .5em;
    }

    tr {
        background: #daf1ff;
    }

    .carousel-inner {
        height: 100%;
    }

    #addSta,#addBus {
        width: 500px;
        height: 600px;
        background-color: #f6fdff;
        box-shadow: 5px 5px 6px #c8c8c887;
        border-radius: 20px 10px;
        margin: 20px;
        padding: 65px 20px;
    }

    .form-control {
        width: 450px;
        height: 45px;
        background-color: #f0f0f0;
        border: none;
    }

    .form-control::placeholder {
        transition: ease 0.5s;
    }

    .form-control:focus::placeholder {
        font-size: 14px;
        color: #6a9ce2;
        transition: ease 0.5s;
    }

    .form-control:focus {
        background-color: #f0f0f0;

    }

    .modal {
        z-index: 999;
        position: absolute;
    }
    label{
        font-weight: bold;
    }
    .table{
        font-size: large;
    }
</style>

<body>
    <?php session_start();
        if(!isset($_SESSION['login'])){
            ?>
    <script>
        alert("請先登入!");
        location.href = "./login.php";
    </script>
    <?php
}
include 'nav.php';
include_once "./api/db.php";
    $lows = $conn->query("select * from `indexval`")->fetchAll(PDO::FETCH_ASSOC);
?>
    <main id="app">
        <!-- <form action="./editVal.php" method="post">
            <h4>更改站點</h4>
            <input name="editVal" id="editVal" type="text" max="5" min="1" value="<?=$lows[0]['editVal']?>">
            <input type="submit">
        </form> -->
        <div id="Slider" class="container slide carousel">
            <div class="carousel-indicators">
                <div data-target="#Slider" data-slide-to="0" class="active btn btn-change m-1"><span>接駁車管理</span></div>
                <div data-target="#Slider" data-slide-to="1" class="btn btn-change m-1"><span>站點管理</span></div>
                <div data-target="#Slider" data-slide-to="2" class="btn btn-change m-1"><span>表單管理</span></div>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <table class="table table-striped text-center">
                        <div style="display: flex;align-items: center;justify-content: center;">
                            <h1 class="text-center m-3" style="font-weight: 700;color: #072560;">接駁車管理</h1>
                            <div class="btn btn-success" onclick="$('#Slider').hide();$('.modal.a1').fadeIn()">新增</div>
                        </div>
                        <tr style="background-color: #7aaacc;color: #fff;">
                            <td style="width: 20%;">編號</td>
                            <td style="width: 20%;">車牌</td>
                            <td style="width: 20%;">已行駛時間(分鐘)</td>
                            <td style="width: 20%;">新增時間</td>
                            <td style="width: 20%;">操作</td>
                        </tr>
                        <?php include_once "./api/db.php";
                    $buses = $conn -> query("select * from `bus`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($buses as $bus){
                        ?>
                        <tr>
                            <td>
                                <?=$bus['id']?>
                            </td>
                            <td style="font-weight: bold;">
                                <?=$bus['busName']?>
                            </td>
                            <td>
                                <?=$bus['minute']?>
                            </td>
                            <td>
                                <?=$bus['addTime']?>
                            </td>
                            <td>
                                <div id="editBus_<?=$bus['id']?>" class="btn btn-secondary mr-1" @click="edit('bus',<?=$bus['id']?>);">編輯</div>
                                <div id="btnBus_<?=$bus['id']?>" class="btn btn-danger ml-1" @click="btn('bus',<?=$bus['id']?>)">刪除</div>
                                <div id="delBus_<?=$bus['id']?>" style="display: none;" class="btn btn-outline-danger ml-1" @click="del('bus',<?=$bus['id']?>)">確認刪除</div>
                                <div id="backBus_<?=$bus['id']?>" style="display: none;" class="btn btn-outline-secondary ml-1" @click="back('bus',<?=$bus['id']?>)">取消</div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                </div>
                <div class="carousel-item">
                    <table class="table table-striped text-center">
                        <div style="display: flex;align-items: center;justify-content: center;">
                            <h1 class="m-3" style="font-weight: 700;color: #072560;">站點管理</h1>
                            <div class="btn btn-success" onclick="$('#Slider').hide();$('.modal.a2').fadeIn()">新增</div>
                        </div>
                        <tr style="background-color: #7aaacc;color: #fff;">
                            <td style="width: 12%;">編號</td>
                            <td style="width: 17%;">站點名稱</td>
                            <td style="width: 17%;">行駛時間(分鐘)</td>
                            <td style="width: 17%;">停留時間(分鐘)</td>
                            <td style="width: 17%;">新增時間</td>
                            <td style="width: 20%;">操作</td>
                        </tr>
                        <?php include_once "./api/db.php";
                    $stations = $conn -> query("select * from `station`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($stations as $station){
                        ?>
                        <tr>
                            <td>
                                <?=$station['id']?>
                            </td>
                            <td style="font-weight: bold;">
                                <?=$station['stationName']?>
                            </td>
                            <td>
                                <?=$station['minute']?>
                            </td>
                            <td>
                                <?=$station['waiting']?>
                            </td>
                            <td>
                                <?=$station['addTime']?>
                            </td>
                            <td>
                                <div id="editSta_<?=$station['id']?>" class="btn btn-secondary mr-1" @click="edit('station',<?=$station['id']?>);">編輯</div>
                                <div id="btnSta_<?=$station['id']?>" class="btn btn-danger ml-1" @click="btn('station',<?=$station['id']?>)">刪除</div>
                                <div id="delSta_<?=$station['id']?>" style="display: none;" class="btn btn-outline-danger ml-1" @click="del('station',<?=$station['id']?>)">確認刪除</div>
                                <div id="backSta_<?=$station['id']?>" style="display: none;" class="btn btn-outline-secondary ml-1" @click="back('station',<?=$station['id']?>)">取消</div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                </div>
                <div class="carousel-item">
                    <table class="table table-striped text-center">
                        <div style="display: flex;align-items: center;justify-content: center;">
                            <h1 class="m-3" style="font-weight: 700;color: #072560;">表單管理</h1>
                            <div class="btn btn-success" onclick="$('#Slider').hide();$('.modal.a3').fadeIn()">新增</div>
                        </div>
                        <tr style="background-color: #7aaacc;color: #fff;">
                            <td style="width: 12%;">編號</td>
                            <td style="width: 17%;">參與者名稱</td>
                            <td style="width: 17%;">行駛時間(分鐘)</td>
                            <td style="width: 17%;">停留時間(分鐘)</td>
                            <td style="width: 17%;">新增時間</td>
                            <td style="width: 20%;">操作</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal a1" style="display: none;">
            <form action="./api/add_bus.php" id="addBus" method="post" style="position: absolute;margin: 10% 37%;">
                <h2 class="text-center" style="color: #6a9ce2;">ADD FORM</h2>
                <br>
                <label for="busName">BUS NAME</label>
                <input class="form-group form-control" type="text" name="busName" id="busName"
                    required placeholder="請輸入接駁車名稱">
                <label for="minute">TRAVEL TIME</label>
                <input class="form-group form-control" type="text" name="minute" id="minute" required
                    placeholder="請輸入行駛時間(分鐘)">
                <br>
                <div class="btn btn-secondary" onclick="$('.modal.a1').hide();$('#Slider').fadeIn();">回上頁</div>
                <input type="submit" value="Add(新增)" class="btn btn-primary">
            </form>
        </div>
        <div class="modal a2" style="display: none;">
            <form action="./api/add_station.php" id="addSta" method="post" style="position: absolute;margin: 10% 37%;">
                <h2 class="text-center" style="color: #6a9ce2;">ADD FORM</h2>
                <br>
                <label for="stationName">STATION NAME</label>
                <input class="form-group form-control" type="text" name="stationName" id="stationName"
                required placeholder="請輸入站點名稱">
                <label for="minute">TRAVEL TIME</label>
                <input class="form-group form-control" type="text" name="minute" id="minute" required
                placeholder="請輸入行駛時間(分鐘)">
                <label for="waiting">WAITING TIME</label>
                <input class="form-group form-control" type="text" name="waiting" id="waiting" required
                placeholder="請輸入等待時間(分鐘)">
                <br>
                <div class="btn btn-secondary" onclick="$('.modal.a2').hide();$('#Slider').fadeIn();">回上頁</div>
                <input type="submit" value="Add(新增)" class="btn btn-primary">
            </form>
        </div>
        <div class="modal e1" style="display: none;">
            <form action="./api/edit_bus.php" id="addBus" method="post" style="position: absolute;margin: 10% 37%;">
                <input type="hidden" id="editBusID" name="editBusID">
                <h2 class="text-center" style="color: #6a9ce2;">修改「<span id="busTittle"></span>」接駁車</h2>
                <br>
                <label for="editBus_minute">TRAVEL TIME</label>
                <input class="form-group form-control" type="text" name="editBus_minute" id="editBus_minute" required
                placeholder="請輸入行駛時間(分鐘)">
                <br>
                <div class="btn btn-secondary" onclick="$('.modal.e1').hide();$('#Slider').fadeIn();">回上頁</div>
                <input type="submit" value="EDIT(修改)" class="btn btn-primary">
            </form>
        </div>
        <div class="modal e2" style="display: none;">
            <form action="./api/edit_station.php" id="addBus" method="post" style="position: absolute;margin: 10% 37%;">
                <input type="hidden" id="editStationID" name="editStationID">
                <h2 class="text-center" style="color: #6a9ce2;">修改「<span id="staTittle"></span>」站點</h2>
                <br>
                <label for="editSta_minute">TRAVEL TIME</label>
                <input class="form-group form-control" type="text" name="editSta_minute" id="editSta_minute" required
                    placeholder="請輸入行駛時間(分鐘)">
                <br>
                <label for="edit_waiting">WAITING TIME</label>
                <input class="form-group form-control" type="text" name="edit_waiting" id="edit_waiting" required
                    placeholder="請輸入停留時間(分鐘)">
                <br>
                <div class="btn btn-secondary" onclick="$('.modal.e2').hide();$('#Slider').fadeIn();">回上頁</div>
                <input type="submit" value="EDIT(修改)" class="btn btn-primary">
            </form>
        </div>
    </main>
</body>
<script src="./js/vue3.global.js"></script>
<script src="./js/jquery-3.6.3.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script>
    Vue.createApp({
        data() {
            return {
            }
        },
        methods: {
            btn(table,id){
                if(table === 'bus'){
                    $('#editBus_'+id).hide();
                    $('#btnBus_'+id).hide();
                    $('#delBus_'+id).show();
                    $('#backBus_'+id).show();
                }else if(table === 'station'){
                    $('#editSta_'+id).hide();
                    $('#btnSta_'+id).hide();
                    $('#delSta_'+id).show();
                    $('#backSta_'+id).show();
                }
            },
            back(table,id){
                if(table === 'bus'){
                    $('#editBus_'+id).show();
                    $('#btnBus_'+id).show();
                    $('#delBus_'+id).hide();
                    $('#backBus_'+id).hide();
                }else if(table === 'station'){
                    $('#editSta_'+id).show();
                    $('#btnSta_'+id).show();
                    $('#delSta_'+id).hide();
                    $('#backSta_'+id).hide();
                }
            },
            edit(table,id){
                if(table === 'bus'){
                    $(".modal.e1").fadeIn();
                    $("#Slider").hide();
                    $.getJSON('./api/get_bus.php',{table,id},(data)=>{
                        $('#busTittle').text(data.busName);
                        $('#editBus_minute').val(data.minute);
                        $('#editBusID').val(data.id);
                    })
                }else if(table === 'station'){
                    $(".modal.e2").fadeIn();
                    $("#Slider").hide();
                    $.getJSON('./api/get_station.php',{table,id},(data)=>{
                        $('#staTittle').text(data.stationName);
                        $('#editSta_minute').val(data.minute);
                        $('#edit_waiting').val(data.waiting);
                        $('#editStationID').val(data.id);
                    })
                }   
            },
            del(table,id){
                if(table ==='bus'){
                    $.post('./api/del_bus.php',{table,id},()=>{
                        location.reload();
                        alert("已刪除");
                    })
                }else if(table === 'station'){
                    $.post('./api/del_station.php',{table,id},()=>{
                        location.reload();
                        alert("已刪除");
                    })
                }
            },
        },
    }).mount("#app");
</script>
</html>