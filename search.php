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
    body{
        background-color:hsl(205 56% 95% / 1);
    }
    form{
        width: 500px;
        height: 620px;
        background-color: #ffffff;
        border-radius: 20px 10px;
        margin: 20px;
        padding: 65px 20px;
    }
    .form-control{
        width: 450px;
        height: 50px;
        background-color: #f0f0f0;
        border: none;
        position: relative;
        transition: ease 0.5s;
    }
    .form-control::placeholder{
        transition: ease 0.5s;
        z-index: 999;
    }
    .form-control:focus::placeholder{
        font-size: 14px;
        color: #6a9ce2;
        transition: ease 0.5s;
        position: absolute;
    }
    .form-control:focus{
        background-color: #f0f0f0;
        border:none;
    }
    .loginbtn{
        width: 450px;
        height: 50px;
        border-radius: 30px;
        border: 2px solid;
        border-color: #5aa1d3e7;
        background: linear-gradient(to left,#a0d6fb,#6a9ce2,#948fe7) 0 0 / 0 100% no-repeat;
        transition: ease 0.5s;
        font-size: 18px;
        letter-spacing: 1px;
    }
    .loginbtn:hover{
        transition: ease 0.5s;
        color: #ffffff;
        background-size: 100% 100%;
        letter-spacing: 3px;
    }
    label{
        font-size: 16px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .veri{
       font-family: 'Courier New', Courier, monospace;
       font-style: italic;
       font-size: xx-large;
       background-color: #e7f1f5;
       padding:5px 10px;
       user-select: none;
       border-radius: 10px;
       /* border: #a0d6fb 2px solid; */
       text-shadow: 1px 1px 2px #a493ee;
       box-shadow: inset 1px 1px 10px #a8a8a878;
    }
    .signVeri{
       font-family: 'Courier New', Courier, monospace;
       font-style: italic;
       font-size: xx-large;
       background-color: #e7f1f5;
       padding:5px 10px;
       user-select: none;
       border-radius: 10px;
       /* border: #a0d6fb 2px solid; */
       text-shadow: 1px 1px 2px #a493ee;
       box-shadow: inset 1px 1px 10px #a8a8a878;
    }
    .btn-primary{
        background-color: #7bbcdd;
        border: none;
    }
    .error{
        position: absolute;
        left: 0;
        animation: errorAni ease forwards 0.5s;
        background-color: #f3b2b2;
        padding: 5px 10px;
        margin: 10px;
        font-size: 18px;
        color: rgb(205, 86, 86);
        cursor: default;
        border: 1px #dfb7b7 solid; 
        border-radius:5px ;
    }
</style>
<body>
    <?php include "nav.php"; 
    ?>
    <main style="display: flex;align-items: center;justify-content: center;" id="app">
        <form action="./api/search.php" method="post" class="shadow">
            <h2 class="text-center" style="color: #6a9ce2;font-weight: bold;">班次查詢</h2>
            <br>
            <label for="email">EMAIL</label>
            <input class="form-group form-control" type="email" name="email" id="email" required placeholder="請輸入信箱">
            <input type="submit" value="Submit(送出)" class="loginbtn mb-3">
        </form>
    </main>
    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/vue3.global.js"></script>
    <script>
        $(".1").load("./h1.html");
    </script>
</body>
</html>