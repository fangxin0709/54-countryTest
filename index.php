<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台北101接駁系統</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="shortcut icon" href="./img/incn.png" type="image/x-icon">
</head>
<style>
    .longStr {
        width: 300px;
        height: 30px;
        background-color: #8ac7ed;
    }

    .point {
        width: 60px;
        height: 60px;
        cursor: pointer;
        transition: 0.1s;
    }
    .point:hover{
        transition: 0.3s;
        transform: scale(1.1);
    }
    .shortStrDown {
        background-color: #8ac7ed;
        height: 100px;
        width: 30px;
        position: relative;
        top: 35px;
    }

    .shortStrUp {
        background-color: #8ac7ed;
        height: 100px;
        width: 30px;
        position: relative;
        bottom: 35px;
    }

    tr:nth-of-type(even) {
        flex-direction: row-reverse;
    }

    td {
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    table {
        border-collapse: collapse;
    }

    .show3 {
        position: absolute;
        background-color: #f6f6f6;
        width: 150px;
        border: #62a4ea outset;
        border-radius: 10px;
        bottom: 80px;
        z-index: 999;
        text-align: center;
        padding: 5px 5px;
        animation: show3 ease-in-out 0.3s;
    }

    @keyframes show3 {
        from {
            transition: ease;
            transform: translateY(6px);
            transform: translateY(10px);
        }
    }

    p {
        position: absolute;
        z-index: 999;
    }
</style>
<body>
            <?php
            include "./nav.php";
            include_once "./api/db.php";
            $lows = $conn->query("select * from `indexval`")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div style="display: flex;justify-content: center;; align-items: center;" class="m-3">
                <input name="editSta" id="editSta" type="range" max="5" min="1" value="<?= $lows[0]['editVal'] ?>" class="mr-2">
                <span style="font-size: x-large;" id="editVal">每列顯示<span style="font-size: xx-large;font-style: italic;font-weight: bold;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;color: #558fcd;"><?= $lows[0]['editVal'] ?></span>站</span>
            </div>
            <div class="d-flex " style="justify-content: center;align-items: center;">
            <table class="busTable">
            <?php
            $stations = $conn->query("select * from `station` order by `rank` asc")->fetchAll(PDO::FETCH_ASSOC);
            $div = $lows[0]['editVal'];
            $totalRows = count($stations);
            $totalRows3 = ceil($totalRows / $div);
            for ($i = 0; $i < $totalRows3; $i++) {
                ?>
            <tr style="display: flex;margin:50px;">
                <?php
                    for ($j = 0; $j < $div; $j++) {
                        $index = $i * $div + $j;
                        if ($index >= $totalRows) {
                            break;
                        }
                        $station = $stations[$index];
                        //計算
                        
                        $prev = $conn->query("SELECT SUM(`minute` + `waiting`) FROM `station` WHERE `rank` < {$station['rank']}")->fetchColumn();
                        $arrive = $prev + $station['minute'];
                        $leave = $arrive + $station['waiting'];
                        // 顯示在主頁的一台車
                        $bus = $conn->query("SELECT * FROM `bus` WHERE `minute` <= $leave ORDER BY `minute` DESC")->fetch(PDO::FETCH_ASSOC);
                        if ($bus) {
                            $station['busName'] = $bus['busName'];
                            $station['time'] = ($bus['minute'] < $arrive) ? "約" . ($arrive - $bus['minute']) . "分鐘" : "<span style='color:red;'>已到站</span>";
                        } else {
                            $station['busName'] = '';
                            $station['time'] = "<span style='color:#888;'>未發車</span>";
                        }
                        // 顯示在小格子的三台車
                        $buses = $conn->query("SELECT * FROM `bus` WHERE `minute` <= $leave ORDER BY `minute` DESC")->fetchAll(PDO::FETCH_ASSOC);
                        if (count($buses) < 3) {
                            $addBus3 = $conn->query("SELECT `busName`, `minute` FROM `bus` WHERE `minute` > $leave ORDER BY `minute` DESC LIMIT " . (3 - count($buses)))->fetchAll(PDO::FETCH_ASSOC);
                            $buses = array_merge($buses, $addBus3);
                        }
                        // 構建車輛信息
                        $busInfo = [];
                        foreach ($buses as $bus) {
                            $info = [];
                            $info['busName'] = $bus['busName'];
                            if ($bus['minute'] <= $leave) {
                                $info['time'] = ($bus['minute'] < $arrive) ? "約" . ($arrive - $bus['minute']) . "分鐘" : "<span style='color:red;'>已到站</span>";
                            } else {
                                $info['time'] = "<span style='color:#888;'>未發車</span>";
                            }
                            $busInfo[] = $info;
                        }
                        ob_start();
                        foreach ($busInfo as $info) {
                            echo "<span>{$info['busName']} {$info['time']}</span><br>";
                        }
                        $station['bus_html'] = ob_get_clean();
                        ?>
                <td id="<?= $station['id'] ?>">
                    <div style="position: relative;" class="longStr"></div>
                    <p style="margin-bottom: 135px;font-weight: bold;">
                        <?= $station['busName'] ?>
                    </p>
                    <p style="margin-bottom: 85px;">
                        <?= $station['time'] ?>
                    </p>
                    <img style="position: absolute;border-radius: 20px;" class="point" src="./img/point1.png" alt=""
                    onmousemove="show(<?= $station['id'] ?>)" onmouseout="bye(<?= $station['id'] ?>)">
                    <div id="show_<?= $station['id'] ?>" class="show3" style="display: none;">
                        <?= $station['bus_html']; ?>
                    </div>
                    <p style="margin-bottom: -85px;font-weight: bolder;">
                        <?= $station['stationName'] ?>
                    </p>
                </td>
                <?php
            }
                    ?>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script>
        function show(id) {
            $("#show_" + id).fadeIn('fast');
        }
        function bye(id) {
            $("#show_" + id).fadeOut('fast');

        }
        //開頭線判斷
        function firstStr() {
            $("tr:first-child").css({
                'justify-content': 'flex-end'
            })
            $("tr:first-child>td:first-child").css({
                "justify-content": "flex-start",
            });
            $("tr:first-child>td:first-child>div.longStr").css({
                "border-radius": "20px 0 0 20px",
                "width": "180px",
            });
            $("tr:first-child>td:first-child>.show3").css({
                "right": "80px",
            });
        }
        //結尾線判斷
        function lastStr() {
            var lastTrIndex = $("tr:last-child").index();
            if (lastTrIndex % 2 === 0) {
                //單數
                $("tr:last-child>td:last-child").css({
                    "justify-content": "flex-end",
                });
                $("tr:last-child>td:last-child>div.longStr").css({
                    "width": "180px",
                    "border-radius": "0px 20px 20px 0px",
                });
                $("tr:last-child>td:last-child>.show3").css({
                    "left": "80px",
                });
            } else {
                //雙數
                $("tr:last-child>td:last-child").css({
                    "justify-content": "flex-start",
                });
                $("tr:last-child>td:last-child>div.longStr").css({
                    "border-radius": "20px 0px 0px 20px",
                    "width": "180px",
                });
                $("tr:last-child>td:last-child>.show3").css({
                    "right": "80px",
                });
            }
        };
        //單數轉彎線
        function oddStr() {
            let html = "<div class='shortStrDown'></div>";
            let html1 = document.createElement("put");
            let $html = $(html);
            let $html1 = $(html1);
            $("tr:nth-child(odd):not(:last-child)>td:last-child").after($html).after($html1);
        }
        function oddStr1() {
            let html = "<div class='shortStrUp'></div>";
            let html1 = document.createElement("put");
            let $html = $(html);
            let $html1 = $(html1);
            $("tr:nth-child(odd):not(:first-child)>td:first-child").before($html).before($html1);
        }
        //偶數轉彎線
        function evenStr() {
            let html = "<div class='shortStrDown'></div>";
            let html1 = document.createElement("put");
            let $html = $(html);
            let $html1 = $(html1);
            $("tr:nth-child(even):not(:last-child)>td:last-child").after($html).after($html1);
        }
        function evenStr1() {
            let html = "<div class='shortStrUp'></div>";
            let html1 = document.createElement("put");
            let $html = $(html);
            let $html1 = $(html1);
            $("tr:nth-child(even)>td:first-child").before($html).before($html1);
        }
        firstStr();
        lastStr();
        oddStr();
        oddStr1();
        evenStr();
        evenStr1();
        function editVal() {
            $("#editSta").on('input', function () {
                var editVal = $(this).val();
                $.ajax({
                    url: './api/editVal.php',
                    method: 'POST',
                    data: { editVal: editVal },
                    success: function (res) {
                        location.reload();
                    },
                })
            })
        }
        editVal();
        </script>
</body>
</html>