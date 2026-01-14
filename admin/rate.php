<?php
include __DIR__ . '/../config/db.php';

// زيادة العدد + إرجاع الجديد
$conn->query("UPDATE rating_counter SET total = total + 1 WHERE id = 1");

$res = $conn->query("SELECT total FROM rating_counter WHERE id = 1");
$row = $res->fetch_assoc();

echo $row['total'];
?>
