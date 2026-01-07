<?php
include __DIR__ . '/../config/db.php';

$id = $_POST["id"];

$conn->query("DELETE FROM orders WHERE id='$id'");

echo "OK";
