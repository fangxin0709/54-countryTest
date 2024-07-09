<?php include "./api/db.php";
$rows = $conn->query("SELECT `id`,`name`,`email`,`takeBus` FROM `form` WHERE `close` = 0")->fetchAll(PDO::FETCH_ASSOC);
$allBus = [];
    foreach ($rows as $row) {
        $busName = $row['takeBus'];
        if (!isset($allBus[$busName])) {
            $allBus[$busName] = [
                'bus' => $busName,
                'participants' => []
            ];
        }
        unset($row['takeBus']);
        $allBus[$busName]['participants'][] = $row;
    }
$get = array_values($allBus);
echo json_encode($get,JSON_UNESCAPED_UNICODE);
?>
