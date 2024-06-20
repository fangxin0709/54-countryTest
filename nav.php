<nav class="navbar navbar-light navbar-expand-lg" style="display: flex;justify-content: space-between;align-items: center;background-color: #5aa1d3e7;height: 120px;backdrop-filter: blur(10px);box-shadow: 1px 1px 5px #0000005f;">
        <ul class="navbar-nav" style="display: flex;align-items: center;">
            <img src="./img/54logo-101.png" style="height: 80px;width: 160px;" alt="">
            <a href="./index.php" style="text-decoration: none;"><h1 class="nav-link ml-2 mt-2" style="font-weight: 700;color: #ffffff;">台北 101 接駁系統</h1></a>
            <li class="nav-item m-2"><a href="./form.php" class="nav-link" style="font-size: x-large;font-weight: bold;color: #ffffff;">接駁意願調查表單</a></li>
            <li class="nav-item m-2"><a href="./search.php" class="nav-link" style="font-size: x-large;font-weight: bold;color: #ffffff;">班次查詢</a></li>
        </ul>
        <ul class="navbar-nav"  style="display: flex;align-items: center;">
            <li class="nav-item m-2"><a href="./admin.php" class="nav-link" style="font-size: x-large;font-weight: bold;color: #0067d4;">系統管理</a></li>
            <?php if(isset($_SESSION['login'])){
                ?>
                <li class="nav-item"><a href="./api/lonout.php" style="font-size: 20px;font-weight: bold;color: #ff0000ba;text-decoration: none;">登出</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>