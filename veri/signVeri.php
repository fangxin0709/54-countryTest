<?php
session_start();
$all=str_split("qwertyuiopasdfghjklzxcvbnm12345678900987654321");
$gets=array_rand($all,6);
$abc='';
foreach($gets as $get){
    $abc=$abc.$all[$get];
}
$_SESSION['signVeri'] = $abc;
echo $_SESSION['signVeri'];