<?php
include __DIR__ . '/../config/db.php';;
$res = $conn->query("SELECT total FROM rating_counter WHERE id = 1");
$row = $res->fetch_assoc();
echo $row['total'];
?>
