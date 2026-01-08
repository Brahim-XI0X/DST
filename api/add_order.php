<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");
include "../config/db.php";

$name    = $_POST["name"];
$phone   = $_POST["phone"];
$service = $_POST["service"];
$usd     = $_POST["usd"];
$total   = $_POST["total"];
$email   = $_POST["email"];

$stmt = $conn->prepare("INSERT INTO orders (name, phone, service, usd, total) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $phone, $service, $usd, $total);
$stmt->execute();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "ibrahimbdhiafi47@gmail.com";
    $mail->Password   = "mvariophtsftnjtm";
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    $mail->setFrom("YOUR_EMAIL@gmail.com", "DST Tunisia");
    $mail->addAddress($email);
    $mail->addReplyTo("YOUR_EMAIL@gmail.com", "DST Support");
    $mail->CharSet = "UTF-8";
    $mail->isHTML(true);

    $mail->Subject = "Your Order Confirmation - DST";
    $mail->Body = "
        <h2>Hello $name 👋</h2>
        <p>Thank you for your order.</p>

        <b>Order Details:</b><br>
        Service: $service <br>
        Amount: $usd USD <br>
        Total: $total DT <br><br>

        <p>We will contact you soon.</p>
        <p>Regards,<br>DST Tunisia Team</p>
    ";

    $mail->send();
} catch (Exception $e) {}

echo "DONE";
