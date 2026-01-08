<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// المسار الصحيح
include __DIR__ . '/../config/db.php';

// للتأكد من وجود اتصال
if(!$conn){
    die("DB connection failed");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact (fullname, email, phone, message)
            VALUES ('$fullname', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        header("Location: thankyou.html");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
