<?php session_start();
if(!isset($_SESSION['login'])){
    ?>
    <script>
        alert("請先登入!");
        location.href="./login.php";
    </script>
    <?php
}