<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台北101接駁系統</title>
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
     border-radius:5px;
    }
    @keyframes errorAni {
        from{
            top: 300px;
        }
        to{
            top: 130px;
        }
    }
</style>
<body>
    <?php include "nav.php";
          if(isset($_GET['error'])){
            switch($_GET['error']){
                case '1':
                    ?>
                    <div class="error"><span onclick="$('.error').hide();" style="cursor: pointer;" >&times;</span>  驗證碼錯誤</div>
                    <?php
                break;
                case '2':
                    ?>
                    <div class="error"><span onclick="$('.error').hide();" style="cursor: pointer;">&times;</span>  帳號密碼錯誤</div>
                    <?php
                break;            
                case '3':
                        ?>
                        <div class="error"><span onclick="$('.error').hide();" style="cursor: pointer;" >&times;</span>  驗證碼錯誤</div>
                        <?php
                break;
            }
          }
    ?>
    <main style="display: flex;align-items: center;justify-content: center;" id="app">
        <form action="./api/login.php" method="post" id="loginForm" class="shadow">
            <h2 class="text-center" style="color: #6a9ce2;">LOGIN</h2>
            <br>
            <label for="acc">USER NAME</label>
            <input class="form-group form-control" type="text" name="acc" id="acc" required placeholder="請輸入帳號">
            <label for="acc">PASSWORD</label>
            <div class="d-flex" style="align-items: center;">
                <input style="width:350px" class="form-group form-control" :type="this.passwordType ? 'text' : 'password'" name="pw" id="pw" required placeholder="請輸入密碼">
                <div @click='this.passwordType =! this.passwordType ' class="btn btn-primary mb-3 ml-2" v-text="this.passwordType ? '隱藏密碼' : '查看密碼'"></div>
            </div>
            <label for="veri">VERIFACATION</label>
            <input class="form-group form-control" type="text" name="veri" id="veri" required placeholder="請輸入驗證碼">
            <div class="d-flex" style="flex-direction: row-reverse;align-items: center;">
                <span class="veri mr-2 ml-2">0000</span>
                <div class="btn btn-outline-success" @click="rc()">重新產生驗證碼</div>
            </div>
            <br>
            <input type="submit" value="Login(登入)" class="loginbtn mb-3">
            <div style="text-align: center;color: #888;">還沒註冊嗎？ 
                <span style="color:skyblue;cursor: pointer;" onclick="$('#loginForm').hide();$('#signForm').fadeIn();">註冊</span>
            </div>
        </form>
        <form action="./api/sign.php" method="post" id="signForm" style="display:none;">
            <h2 class="text-center" style="color: #6a9ce2;">SIGN UP</h2>
            <br>
            <label for="signAcc">SIGN NAME</label>
            <input class="form-group form-control" type="text" name="signAcc" id="signAcc" required placeholder="請輸入帳號">
            <label for="signPw">PASSWORD</label>
            <div class="d-flex" style="align-items: center;">
                <input style="width:350px" class="form-group form-control" :type="this.passwordType ? 'text' : 'password'" name="signPw" id="signPw" required placeholder="請輸入密碼">
                <div @click='this.passwordType =! this.passwordType ' class="btn btn-primary mb-3 ml-2" v-text="this.passwordType ? '隱藏密碼' : '查看密碼'"></div>
            </div>
            <label for="signVeri">VERIFACATION</label>
            <input class="form-group form-control" type="text" name="signVeri" id="signVeri" required placeholder="請輸入驗證碼">
            <div class="d-flex" style="flex-direction: row-reverse;align-items: center;">
                <span class="signVeri mr-2 ml-2">0000</span>
                <div class="btn btn-outline-success" @click="signRc()">重新產生驗證碼</div>
            </div>
            <br>
            <input type="submit" value="Sign up(註冊)" class="loginbtn mb-3">
            <div style="text-align: center;color: #888;">已經有帳號了？ 
                <span style="color:skyblue;cursor: pointer;" onclick="$('#loginForm').fadeIn();$('#signForm').hide();">登入</span>
            </div>
        </form>
    </main>
    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/vue3.global.js"></script>
    <script>
        $(document).ready(function(){
            $(".veri").load("./veri/veri.php");
            $(".signVeri").load("./veri/signVeri.php");
        })
        Vue.createApp({
            data(){
                return{
                    passwordType: false,
                }
            },
            methods:{
                rc(){
                    $(".veri").load("./veri/veri.php");
                },
                signRc(){
                    $(".signVeri").load("./veri/signVeri.php");
                }
            },
        }).mount("#app");
        if (window.performance) {
            if (performance.navigation.type === 1) {
                window.location.href = 'login.php';
            }
        }
    </script>
</body>
</html>