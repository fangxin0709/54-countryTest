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
        height: 50px;
        background-color: #f0f0f0;
        border: none;
        transition: ease 0.5s;
    }
    .form-control:focus::placeholder{
        font-size: 14px;
        color: #6a9ce2;
        position: absolute;
    }
    .form-control:focus{
        background-color: #f0f0f0;
        border:none;
    }
</style>
<body>
    <?php include "nav.php"; 
    ?>
    <main style="display: flex;align-items: center;justify-content: center;" id="app">
        <form action="./api/res_form.php" method="post" class="shadow">
            <h2 class="text-center" style="color: #6a9ce2;font-weight: bold;">接駁意願表單</h2>
            <br>
            <label for="name">USER NAME</label>
            <input class="form-group form-control" type="text" name="name" id="name" required placeholder="請輸入姓名">
            <label for="email">EMAIL</label>
            <input class="form-group form-control" type="email" name="email" id="email" required placeholder="請輸入信箱">
            <input type="submit" value="Submit(送出)" class="loginbtn mb-3">
        </form>
    </main>
    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/vue3.global.js"></script>
</body>
</html>