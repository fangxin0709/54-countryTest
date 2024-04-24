<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南港展覽館接駁專車</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="shortcut icon" href="./incn.png" type="image/x-icon">
</head>
<style>
    body{
        background-color:hsl(205 56% 95% / 1);
    }
    form{
        width: 500px;
        height: 650px;
        background-color: #ffffff;
        backdrop-filter: blur(10px);
        box-shadow: 5px 5px 6px #c8c8c887;
        border-radius: 20px 10px;
        margin: 20px;
        padding: 50px 20px;
    }
    .form-control{
        width: 450px;
        height: 45px;
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
        /* font-size: 20px; */
        background-size: 100% 100%;
        letter-spacing: 3px;
    }
</style>
<body>
    <nav class="navbar navbar-light navbar-expand-lg" style="display: flex;justify-content: space-between;align-items: center;background-color: #5aa1d3e7;height: 120px;backdrop-filter: blur(10px);box-shadow: 1px 1px 5px #0000005f;">
        <ul class="navbar-nav">
            <img src="./53.png" style="height: 80px;width: 150px;" alt="">
            <a href="./index.php" style="text-decoration: none;"><h1 class="nav-link ml-2 mt-2" style="font-weight: 700;color: #ffffffca;">南港展覽館接駁專車</h1></a>
        </ul>
        <?php if(isset($_SESSION['login'])){
            ?>
        <li class="nav-item"><a href="./api/lonout.php" class="nav-link">登出</a></li>
            <?php
        }
        ?>
        <ul class="navbar-nav">
            <li class="nav-item m-2"><a href="./admin.php" class="nav-link" style="font-size: x-large;font-weight: bold;color: #ffffffca;">站點管理</a></li>
            </ul>
    </nav>
    <main style="display: flex;align-items: center;justify-content: center;">
        <form action="./api/login.php" method="post">
            <input class="form-group form-control" type="text" name="acc" id="acc" required placeholder="User Name(帳號)">
            <input class="form-group form-control" type="text" name="pw" id="pw" required placeholder="Password(密碼)">
            <input type="submit" value="Login(登入)" class="loginbtn">
        </form>
    </main>
    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/bootstrap.js"></script>
</body>
</html>