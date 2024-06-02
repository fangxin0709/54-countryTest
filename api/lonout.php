<?php session_start();
unset($_SESSION['login']);
?>
<script>
    alert("已登出 謝謝使用!");
    location.href="../login.php";
</script>