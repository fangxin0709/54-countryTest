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
    .btn-primary {
        width: 450px;
        margin-top: 5px;
    }

    .btn-back {
        color: #888;
        font-size: xxx-large;
        cursor: pointer;
        width: 40px;
        height: 40px;
        display: flex;
        flex-direction: row-reverse;
        position: absolute;
        top: 0;
        right: 20px;
    }

    .table td {
        border: none;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfdfe;
    }

    td:first-child {
        border-radius: 10px 0 0 10px;
    }

    td:last-child {
        border-radius: 0px 10px 10px 0px;
    }

    table {
        border-collapse: separate;
        border-spacing: 0 .5em;
    }

    tr {
        background: #daf1ff;
    }

    .ui-state-highlight {
        height: 62px;
        line-height: 1.2em;
        /* border: #6a9ce2 1px solid ; */
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
                <div class="carousel-item 1 active">
                    <div style="display: flex;align-items: center;justify-content: center;">
                        <h1 class="text-center m-3" style="font-weight: 700;color: #072560;">接駁車管理</h1>
                        <div class="btn btn-success" onclick="$('.modal.a1').fadeIn('fast')">新增</div>
                    </div>
                    <div style="overflow: scroll;overflow-x: hidden;height: 700px;" id="busOver">
                        <table class="table table-striped text-center" id='bus' @click="setDragable('bus')">
                            <thead>
                                <tr style="background-color: #7aaacc;color: #fff;">
                                    <td style="width: 20%;">編號</td>
                                    <td style="width: 20%;">車牌</td>
                                    <td style="width: 20%;">已行駛時間(分鐘)</td>
                                    <td style="width: 20%;">新增時間</td>
                                    <td style="width: 20%;">操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include_once "./api/db.php";
                            $buses = $conn -> query("select * from `bus` ORDER BY `rank`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($buses as $bus){
                        ?>
                                <tr data-id="<?=$bus['id']?>">
                                    <td>
                                        <?=$bus['id']?>
                                    </td>
                                    <td style="font-weight: bold;">
                                        <?=$bus['busName']?>
                                    </td>
                                    <td>
                                        <?=$bus['minute']?>分鐘
                                    </td>
                                    <td>
                                        <?=$bus['addTime']?>
                                    </td>
                                    <td>
                                        <div id="editBus_<?=$bus['id']?>" class="btn btn-secondary mr-1"
                                            @click="edit('bus',<?=$bus['id']?>);">編輯</div>
                                        <div id="btnBus_<?=$bus['id']?>" class="btn btn-danger ml-1"
                                            @click="btn('bus',<?=$bus['id']?>)">刪除</div>
                                        <div id="delBus_<?=$bus['id']?>" style="display: none;"
                                            class="btn btn-outline-danger ml-1" @click="del('bus',<?=$bus['id']?>)">確認刪除
                                        </div>
                                        <div id="backBus_<?=$bus['id']?>" style="display: none;"
                                            class="btn btn-outline-secondary ml-1" @click="back('bus',<?=$bus['id']?>)">
                                            取消</div>
                                    </td>
                                </tr>
                                <?php
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="carousel-item 2">
                    <div style="display: flex;align-items: center;justify-content: center;">
                        <h1 class="m-3" style="font-weight: 700;color: #072560;">站點管理</h1>
                        <div class="btn btn-success" onclick="$('.modal.a2').fadeIn('fast')">新增</div>
                    </div>
                    <div style="overflow: scroll;overflow-x: hidden;height: 700px;" id='stationOver'>
                        <table class="table table-striped text-center" id="station" @click="setDragable('station')">
                            <thead>
                                <tr style="background-color: #7aaacc;color: #fff;">
                                    <td style="width: 10%;">編號</td>
                                    <td style="width: 17%;">站點名稱</td>
                                    <td style="width: 17%;">行駛時間(分鐘)</td>
                                    <td style="width: 17%;">停留時間(分鐘)</td>
                                    <td style="width: 19%;">新增時間</td>
                                    <td style="width: 20%;">操作</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php include_once "./api/db.php";
                            $stations = $conn -> query("select * from `station` ORDER BY `rank`")->fetchAll(PDO::FETCH_ASSOC);
                            foreach($stations as $station){
                        ?>
                                <tr data-id="<?=$station['id']?>">
                                    <td>
                                        <?=$station['id']?>
                                    </td>
                                    <td style="font-weight: bold;">
                                        <?=$station['stationName']?>
                                    </td>
                                    <td>
                                        <?=$station['minute']?>分鐘
                                    </td>
                                    <td>
                                        <?=$station['waiting']?>分鐘
                                    </td>
                                    <td>
                                        <?=$station['addTime']?>
                                    </td>
                                    <td>
                                        <div id="editSta_<?=$station['id']?>" class="btn btn-secondary mr-1"
                                            @click="edit('station',<?=$station['id']?>);">編輯</div>
                                        <div id="btnSta_<?=$station['id']?>" class="btn btn-danger ml-1"
                                            @click="btn('station',<?=$station['id']?>)">刪除</div>
                                        <div id="delSta_<?=$station['id']?>" style="display: none;"
                                            class="btn btn-outline-danger ml-1"
                                            @click="del('station',<?=$station['id']?>)">確認刪除</div>
                                        <div id="backSta_<?=$station['id']?>" style="display: none;"
                                            class="btn btn-outline-secondary ml-1"
                                            @click="back('station',<?=$station['id']?>)">取消</div>
                                    </td>
                                </tr>
                                <?php
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="carousel-item 3" style="position: relative;">
                    <?php $opens = $conn->query("select * from `formopen`")->fetchAll(PDO::FETCH_ASSOC); 
                          include "./api/db.php";
                          $rows = $conn->query("select * from `form` where `checked` ='1' AND `close`='1'")->fetchAll(PDO::FETCH_ASSOC);
                          $peoples = $conn->query("select * from `people`")->fetchAll(PDO::FETCH_ASSOC);
                          $allReses = count($rows);
                          $people = $peoples[0]['people'];
                          $needBus = ceil($allReses / $people);
                    ?>
                    <div class="dropdown" style="position: absolute;top: 25px;left: 5px;">
                        <button class="btn btn-lg btn-secondary dropdown-toggle" data-bs-toggle="dropdown">意願調查結果</button>
                        <div class="dropdown-menu">
                                <div onclick="showForm('res',this)" class="dropdown-item active">意願調查結果</div>
                                <div onclick="showForm('list',this)" class="dropdown-item">參與者名單</div>
                                <div onclick="showForm('form',this)" class="dropdown-item">所有資料總覽</div>
                        </div>
                    </div>
                    <form action="./api/add_form.php" method="post"
                        style="display: flex;align-items: center;position: absolute;left: 300px;top: 75px;">
                        <input type="email" name="email" id="email" class="form-control form-group m-0"
                            placeholder="請設定參與者信箱" required>
                        <input type="submit" class="btn btn-success ml-2" value="設定">
                    </form>
                    <div style="display: flex;align-items: center;justify-content: center;">
                        <h1 class="m-3" style="font-weight: 700;color: #072560;">表單管理</h1>
                    </div>
                    <div class="custom-control custom-switch" style="position: absolute;">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1"
                            value="<?=$opens[0]['active']?>">
                        <label class="custom-control-label" for="customSwitch1">是否啟用表單</label>
                    </div>
                    <form action="./api/give_bus.php" method="post"
                        style="position: absolute;display: flex;align-items: center;right: 0;">
                        <input type="hidden" value="<?=$needBus?>" name="needBus" id="needBus">
                        <div>
                            <div style="font-size: large;font-weight: bold;">目前需派遣<span style="color: #072560;"><?=$needBus;?></span>輛接駁車</div>
                            <div style="text-align: center;">一台車可容納<input min="1" style="width: 50px;height: 20px;border-radius: 5px;border: 1px solid #888;background-color: #f0f0f0;font-weight: bold;"
                                    type="number" id="people" name="people" value="<?=$peoples[0]['people']?>">人</div>
                        </div>
                        <input type="submit" class="btn btn-outline-primary ml-2" value="分配接駁車"></input>
                    </form>
                    <div style="overflow: scroll;overflow-x: hidden;height: 700px;position: relative;top: 45px;"
                        id="formOver">
                        <table class="table table-striped text-center" id="form" style="display: none;"
                            @click="setDragable('form')">
                            <thead>
                                <tr style="background-color: #7aaacc;color: #fff;">
                                    <td style="width: 10%;">編號</td>
                                    <td style="width: 17%;">參與者名稱</td>
                                    <td style="width: 17%;">電子郵件</td>
                                    <td style="width: 19%;">是否回覆意願</td>
                                    <td style="width: 17%;">分配車輛</td>
                                    <td style="width: 20%;">新增時間</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include "./api/db.php";
                        $forms = $conn->query("select * from `form`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($forms as $form){
                        if($form['checked']=='0'){
                            $checked = '否';
                        }else if($form['checked']=='1'){
                            $checked = '是';
                        }else{
                            $checked = '?';
                        }
                        ?>

                                <tr data-id="<?=$form['id']?>">
                                    <td>
                                        <?=$form['id']?>
                                    </td>
                                    <td>
                                        <?=$form['name']?>
                                    </td>
                                    <td>
                                        <?=$form['email']?>
                                    </td>
                                    <td>
                                        <?=$checked?>
                                    </td>
                                    <td>
                                        <?=$form['takeBus']?>
                                    </td>
                                    <td>
                                        <?=$form['addTime']?>
                                    </td>
                                </tr>
                                <?php
                        }
                        ?>
                            </tbody>
                        </table>
                        <table class="table table-striped text-center" id="list" style="display: none;">
                            <thead>
                                <tr style="background-color: #7aaacc;color: #fff;">
                                    <td style="width: 25%;">編號</td>
                                    <td style="width: 25%;">電子郵件</td>
                                    <td style="width: 25%;">分配車輛</td>
                                    <td style="width: 25%;">新增時間</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include "./api/db.php";
                    $lists = $conn->query("select * from `form`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($lists as $list){
                        ?>

                                <tr data-id="<?=$list['id']?>">
                                    <td>
                                        <?=$list['id']?>
                                    </td>
                                    <td>
                                        <?=$list['email']?>
                                    </td>
                                    <td>
                                        <?=$list['takeBus']?>
                                    </td>
                                    <td>
                                        <?=$list['addTime']?>
                                    </td>
                                </tr>
                                <?php
                        }
                        ?>
                            </tbody>
                        </table>
                        <table class="table table-striped text-center" id="res">
                            <thead>
                                <tr style="background-color: #7aaacc;color: #fff;">
                                    <td style="width: 20%;">編號</td>
                                    <td style="width: 20%;">參與者名稱</td>
                                    <td style="width: 20%;">電子郵件</td>
                                    <td style="width: 20%;">新增時間</td>
                                    <td style="width: 20%;">操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include "./api/db.php";
                    $ress = $conn->query("select * from `form` where `checked`='1' AND `close`='1'")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($ress as $res){
                        ?>

                                <tr data-id="<?=$res['id']?>">
                                    <td>
                                        <?=$res['id']?>
                                    </td>
                                    <td>
                                        <?=$res['name']?>
                                    </td>
                                    <td>
                                        <?=$res['email']?>
                                    </td>
                                    <td>
                                        <?=$res['addTime']?>
                                    </td>
                                    <td>
                                        <div id="editForm_<?=$res['id']?>" class="btn btn-secondary mr-1"
                                            @click="edit('form',<?=$res['id']?>)"
                                            onclick="edit('form',<?=$res['id']?>)">編輯
                                        </div>
                                        <div id="btnForm_<?=$res['id']?>" class="btn btn-danger ml-1"
                                            @click="btn('form',<?=$res['id']?>)">刪除</div>
                                        <div id="delForm_<?=$res['id']?>" style="display: none;"
                                            class="btn btn-outline-danger ml-1" @click="del('form',<?=$res['id']?>)">
                                            確認刪除
                                        </div>
                                        <div id="backForm_<?=$res['id']?>" style="display: none;"
                                            class="btn btn-outline-secondary ml-1"
                                            @click="back('form',<?=$res['id']?>)">取消
                                        </div>
                                    </td>
                                </tr>
                                <?php
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- 新增 -->
        <div class="modal a1" style="display: none;">
            <form action="./api/add_bus.php" id="addBus" method="post" class="form"
                style="position: absolute;margin: 10% 37%;">
                <div class="btn-back" onclick="$('.modal.a1').hide();$('#Slider').fadeIn('fast');">&times;</div>
                <h2 class="text-center" style="color: #6a9ce2;">ADD FORM</h2>
                <br>
                <label for="busName">BUS NAME</label>
                <input class="form-group form-control" type="text" name="busName" id="busName" required
                    placeholder="請輸入接駁車名稱">
                <label for="minute">TRAVEL TIME</label>
                <input class="form-group form-control" type="number" min="0" max="9999" name="minute" id="minute"
                    required placeholder="請輸入行駛時間(分鐘)">
                <br>
                <input type="submit" value="Add(新增)" class="loginbtn">
            </form>
        </div>
        <div class="modal a2" style="display: none;">
            <form action="./api/add_station.php" id="addSta" method="post" class="form"
                style="position: absolute;margin: 10% 37%;">
                <div class="btn-back" onclick="$('.modal.a2').hide();$('#Slider').fadeIn('fast');">&times;</div>
                <h2 class="text-center" style="color: #6a9ce2;">ADD FORM</h2>
                <br>
                <label for="stationName">STATION NAME</label>
                <input class="form-group form-control" type="text" name="stationName" id="stationName" required
                    placeholder="請輸入站點名稱">
                <label for="minute">TRAVEL TIME</label>
                <input class="form-group form-control" type="number" min="0" max="9999" name="minute" id="minute"
                    required placeholder="請輸入行駛時間(分鐘)">
                <label for="waiting">WAITING TIME</label>
                <input class="form-group form-control" type="number" min="0" max="9999" name="waiting" id="waiting"
                    required placeholder="請輸入等待時間(分鐘)">
                <br>
                <input type="submit" value="Add(新增)" class="loginbtn">
            </form>
        </div>
        <!-- 修改 -->
        <div class="modal e1" style="display: none;">
            <form action="./api/edit_bus.php" method="post" class="form" style="position: absolute;margin: 10% 37%;">
                <div class="btn-back" onclick="$('.modal.e1').hide();$('#Slider').fadeIn('fast');">&times;</div>
                <input type="hidden" id="editBusID" name="editBusID">
                <h2 class="text-center" style="color: #6a9ce2;">修改「<span id="busTittle"></span>」接駁車</h2>
                <br>
                <label for="editBus_minute">TRAVEL TIME</label>
                <input class="form-group form-control" min="0" max="9999" type="number" name="editBus_minute"
                    id="editBus_minute" required placeholder="請輸入行駛時間(分鐘)">
                <br>
                <input type="submit" value="EDIT(修改)" class="loginbtn">
            </form>
        </div>
        <div class="modal e2" style="display: none;">
            <form action="./api/edit_station.php" method="post" class="form"
                style="position: absolute;margin: 10% 37%;">
                <div class="btn-back" onclick="$('.modal.e2').hide();$('#Slider').fadeIn('fast');">&times;</div>
                <input type="hidden" id="editStationID" name="editStationID">
                <h2 class="text-center" style="color: #6a9ce2;">修改「<span id="staTittle"></span>」站點</h2>
                <br>
                <label for="editSta_minute">TRAVEL TIME</label>
                <input class="form-group form-control" type="number" min="0" max="9999" name="editSta_minute"
                    id="editSta_minute" required placeholder="請輸入行駛時間(分鐘)">
                <br>
                <label for="edit_waiting">WAITING TIME</label>
                <input class="form-group form-control" type="number" min="0" max="9999" name="edit_waiting"
                    id="edit_waiting" required placeholder="請輸入停留時間(分鐘)">
                <br>
                <input type="submit" value="EDIT(修改)" class="loginbtn">
            </form>
        </div>
        <div class="modal e3" style="display: none;">
            <form action="./api/edit_form.php" method="post" class="form" style="position: absolute;margin: 10% 37%;">
                <div class="btn-back" onclick="$('.modal.e3').hide();$('#Slider').fadeIn('fast');">&times;</div>
                <input type="hidden" id="editFormID" name="editFormID">
                <h2 class="text-center" style="color: #6a9ce2;">修改「<span id="formTittle"></span>」參與者</h2>
                <br>
                <label for="name">USER NAME</label>
                <input class="form-group form-control" type="text" min="0" max="9999" required id="name" name="name"
                    placeholder="請輸入參與者名稱">
                <input type="submit" value="EDIT(修改)" class="loginbtn">
            </form>
        </div>
    </main>
</body>
<script src="./js/vue3.global.js"></script>
<script src="./js/jquery-3.6.3.min.js"></script>
<script src="./js/jquery-ui.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./admin.js"></script>
<script>
    $(document).ready(function () {
        let active = $("#customSwitch1").val();
        if (active == '1') {
            $("#customSwitch1").attr('type', true);
        } else {
            $("#customSwitch1").attr('type', false);
        }
    })
    $(document).ready(function () {
        $("#customSwitch1").on('input', function () {
            var checked = $(this).is(":checked");
            if (checked == true) {
                var active = 1;
            } else {
                var active = 0;
            }
            $.ajax({
                url: './api/editOpen.php',
                method: 'POST',
                data: { active: active },
            })
        })
    })
    $(document).ready(function () {
        $('.carousel-indicators .btn').on('click', function () {
            sessionStorage.setItem('activeIndex', $(this).index().toString());
        });
        var activeIndex = sessionStorage.getItem('activeIndex');
        if (activeIndex !== null) {
            $('.carousel-indicators .btn').removeClass('active')
                .eq(parseInt(activeIndex))
                .addClass('active');
            $('.carousel-item').removeClass('active')
                .eq(parseInt(activeIndex))
                .addClass('active');
        }
    });
    $(document).ready(function () {
        $("#people").on('change',()=> {
            var people = $("#people").val();
            if (people < 0 || people == "") { 
                alert("航航很帥!!!")
                $("#people").val(1)
            } else {
                $.ajax({
                    url: './api/editPeople.php',
                    method: 'POST',
                    data: { people: people },
                    success: function (res) {
                        location.reload();
                    },
                })
            }
        })
    })
    function edit(table, id) {
        $(".modal.e3").fadeIn('fast');
        $("#Slider").hide();
        $.getJSON('./api/get_form.php', { table, id }, (data) => {
            $('#formTittle').text(data.email);
            $('#name').val(data.name);
            $('#editFormID').val(data.id);
        })
    }
    function showForm(item, btn) {
        $('#form').hide();
        $('#list').hide();
        $('#res').hide();
        $('#' + item).fadeIn();
        $('.dropdown-item').removeClass('active');
        $(btn).addClass('active');
        let h1 = $(btn).text();
        $(".btn-lg").text(h1);
    }
</script>
</html>