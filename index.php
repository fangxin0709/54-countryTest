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
        background-color: rgb(138, 199, 237);
    }

    .point {
        width: 60px;
        height: 60px;
        /* position: relative; */
    }

    .shortStrDown {
        background-color: rgb(138, 199, 237);
        height: 100px;
        width: 30px;
        position: relative;
        top: 35px;
    }

    .shortStrUp {
        background-color: rgb(138, 199, 237);
        height: 100px;
        width: 30px;
        position: relative;
        bottom: 35px;
    }

    tr:nth-of-type(even) {
        flex-direction: row-reverse;
    }
    td{
        padding: 0;
    }
    table {
        border-collapse: collapse;
    }
</style>

<body>
    <?php 
    session_start();
    include "./nav.php";
    include_once "./api/db.php";
    $lows = $conn->query("select * from `indexval`")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <input name="editSta" id="editSta" type="range" max="5" min="1" value="<?= $lows[0]['editVal'] ?>">
    <span id="editVal">每列顯示<?= $lows[0]['editVal'] ?>站</span>
    <div class="d-flex" style="justify-content: center;align-items: center;">
        <table>
            <?php
            $stations = $conn->query("select * from `station` order by `rank`")->fetchAll(PDO::FETCH_ASSOC);
            foreach($stations as $station){
                $prev=$conn->query("select sum(`minute`+`waiting`) from `station` where `rank` < {$station['rank']}")->fetchColumn();
                $arrive=$prev+$station['minute']; 
                // echo $prev;
                // echo $station['minute'];
                // echo $arrive;
                $leave=$arrive+$station['waiting'];
                echo $leave;
                $bus=$conn->query("select * from `bus` where `minute` <= $leave order by `minute` desc")->fetch();
                // echo $bus['minute'];
                if(!empty($bus)){
                    $station['closest_bus']=$bus['busName'];
                    if($bus['minute'] < $arrive){
                        $station['time']="約".($arrive-$bus['minute'])."分鐘";
                    }else{
                        $station['time']="<span style='color:red;'>已到站</span>";
                    }
                }else{
                    $station['closest_bus']='';
                    $station['time']="<span style='color:#888;'>未發車</span>";
                }
                //以下註解的部分是每列顯示站點 上面多了foreach所以不能運作 之後再調整
                // $div = $lows[0]['editVal'];
                // $totalRows = count($stations);
                // $totalRows3 = ceil($totalRows / $div);
                // for ($i = 0; $i < $totalRows3; $i++) {
                    ?>
                <tr style="display: flex;margin:50px;">
                    <?php
                    // for ($j = 0; $j < $div; $j++) {
                    //         $index = $i * $div + $j;
                    //         if ($index >= $totalRows) {
                    //         break;
                    //     }
                    // $station = $stations[$index];
                    ?>
                        <td style="display: flex; align-items: center; justify-content: center;position: relative;" id="<?=$station['id']?>">
                            <div style="position: relative;" class="longStr"></div>
                            <p style="z-index: 999; position: absolute; margin-bottom: 135px;font-weight: bold;">
                            <?=$station['closest_bus']?>
                        </p>
                            <p style="z-index: 999; position: absolute; margin-bottom: 85px;;">
                            <?=$station['time']?>
                        </p>
                            <img style="position: absolute;border-radius: 20px;" class="point" src="./img/point1.png" alt="">
                            <p style="z-index: 999; position: absolute; margin-bottom: -85px;font-weight: bolder;">
                                <?= $station['stationName'] ?>
                            </p>
                        </td>
                        <?php
                    // }
                    ?>
                </tr>
                <?php
            // }
        }
            ?>
        </table>
    </div>

    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script>
        //開頭線判斷
        function firstStr() {
            $("tr:first-child").css({
                'justify-content': 'flex-end'
            })
            $("tr:first-child>td:first-child>div.longStr").css({
                "border-radius": "20px 0 0 20px",
                "width": "180px",
            });
            // $("tr:first-child>td:first-child>p").css({
            //     'left':'50%',
            //     'transform': 'translateX(50%)',
            // })
            $("tr:first-child>td:first-child").css({
                    "justify-content": "flex-start",
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
                // $("tr:last-child>td:last-child>p").css({
                //     'left':'50%',
                //     'transform': 'translateX(50%)',
                // })
            } else {
                //雙數
                $("tr:last-child>td:last-child").css({
                    "justify-content": "flex-start",
                });
                // $("tr:last-child>td:last-child>p").css({
                //     'left':'50%',
                //     'transform': 'translateX(50%)',
                // })
                $("tr:last-child>td:last-child>div.longStr").css({
                    "border-radius": "20px 0px 0px 20px",
                    "width": "180px",
                });
            }
        };
        //單數轉彎線
        function oddStr() {
            let html = "<div class='shortStrDown'></div>";
            let html1 = document.createElement("put");
            let $html = $(html);
            let $html1 = $(html1);
            $("tr:nth-of-type(odd):not(:last-child)>td:last-child").after($html).after($html1);
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
            $("tr:nth-of-type(even)>td:first-child").before($html).before($html1);
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
                // $("#editVal").text('每列顯示'+ editVal +'站');
                $.ajax({
                    url: 'editVal.php',
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