<?php
include __DIR__ . '/../config/db.php';

$id = $_POST["id"];

$conn->query("UPDATE orders SET status='Done' WHERE id='$id'");

echo "OK";
