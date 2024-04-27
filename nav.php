<nav class="navbar navbar-light navbar-expand-lg" style="display: flex;justify-content: space-between;align-items: center;background-color: #5aa1d3e7;height: 120px;backdrop-filter: blur(10px);box-shadow: 1px 1px 5px #0000005f;">
        <ul class="navbar-nav">
            <img src="./img/53.png" style="height: 80px;width: 150px;" alt="">
            <a href="./index.php" style="text-decoration: none;"><h1 class="nav-link ml-2 mt-2" style="font-weight: 700;color: #ffffff;">台北 101 接駁系統</h1></a>
        </ul>
        <ul class="navbar-nav"  style="display: flex;align-items: center;">
            <li class="nav-item m-2"><a href="./admin.php" class="nav-link" style="font-size: x-large;font-weight: bold;color: #ffffff;">站點管理</a></li>
            <?php if(isset($_SESSION['login'])){
                ?>
                <img src="./img/admin.png" alt="" style="width: 60px;height: 60px;" class="ml-2">
                <h3 class="m-2"><span style="color: navy;">admin </span>您好 !</h3>
                <li class="nav-item"><a href="./api/lonout.php" style="font-size: 20px;font-weight: bold;color: #ff0000ba;text-decoration: none;">登出</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>