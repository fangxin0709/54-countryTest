<?php
include_once 'db.php';

$table = $_POST['table'];
$ranks = $_POST['arr'];

// 取得所有站點的id與排序
$rows = $conn->query("select `id`, `rank` from `{$table}`")->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $newRank = array_search($row['id'], $ranks) + 1; // 数组索引值加1以匹配新的rank值
    $conn->exec("update `{$table}` set `rank`='{$newRank}' where `id`='{$row['id']}'");
}