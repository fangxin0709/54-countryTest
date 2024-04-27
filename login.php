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
        height: 600px;
        background-color: #ffffff;
        box-shadow: 5px 5px 6px #c8c8c887;
        border-radius: 20px 10px;
        margin: 20px;
        padding: 65px 20px;
        /* border-bottom: 100px solid #88d5f9a8; */
    }
    .form-control{
        width: 450px;
        height: 45px;
        background-color: #f0f0f0;
        border: none;
    }
    .form-control::placeholder{
        transition: ease 0.5s;
    }
    .form-control:focus::placeholder{
        font-size: 14px;
        color: #6a9ce2;
        transition: ease 0.5s;
    }
    .form-control:focus{
        background-color: #f0f0f0;
        
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
    .btn-primary{
        background-color: #7bbcdd;
        border: none;
    }
</style>
<body>
    <?php include "nav.php";?>
    <main style="display: flex;align-items: center;justify-content: center;" id="app">
        <form action="./api/login.php" method="post">
            <h2 class="text-center" style="color: #6a9ce2;">LOGIN FORM</h2>
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
                <div class="btn btn-outline-success" onclick="rc()">重新產生驗證碼</div>
            </div>
            <br>
            <input type="submit" value="Login(登入)" class="loginbtn">
        </form>
    </main>
    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        Vue.createApp({
            data(){
                return{
                    passwordType: false,
                }
            },
            methods:{
                
            },
        }).mount("#app");

        $(".veri").load("./veri.php");
        function rc(){
            $(".veri").load("./veri.php");
        }
    </script>
</body>
</html>