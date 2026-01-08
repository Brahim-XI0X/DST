<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");
include "../config/db.php";

// Save in DB
$name   = $_POST["name"];
$phone  = $_POST["phone"];
$service= $_POST["service"];
$usd    = $_POST["usd"];
$total  = $_POST["total"];

$sql = "INSERT INTO orders (name, phone, service, usd, total) 
VALUES ('$name', '$phone', '$service', '$usd', '$total')";

$conn->query($sql);


// ---------------- EMAIL ----------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";

$mail = new PHPMailer(true);

try {

    // SMTP
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;

    // ⚠️ عدّل بهذه المعلومات
    $mail->Username   = "ibrahimbdhiafi47@gmail.com";
    $mail->Password   = "mvar ioph tsft njtm";

    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    // Sender
    $mail->setFrom("ibrahimbdhiafi47@gmail.com", "DST Tunisia");

    // Receiver (Client)
    $mail->addAddress($_POST["email"]);

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

} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

echo "DONE";

