<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

include __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $service = $_POST["service"] ?? '';
    $usd = $_POST["usd"] ?? 0;
    $total = $_POST["total"] ?? 0;

    if ($name === '' || $phone === '' || $service === '' || !$usd) {
        echo "Missing fields";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO orders (name, phone, service, usd, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdd", $name, $phone, $service, $usd, $total);

    if ($stmt->execute()) {
        $clientPhone = $phone; // رقم العميل من الفورم

// حذف أي مسافات
$clientPhone = str_replace(" ", "", $clientPhone);

// تحويله لرقم دولي تونسي إذا كتب 2xxxxxxxx
if(strlen($clientPhone) == 8){
   $clientPhone = "216" . $clientPhone;
}

$message = urlencode("
مرحبا $name 👋
تم استلام طلبك في Digital Services Tunisia (DST)

الخدمة: $service
المبلغ بالدولار: $usd$
المجموع: $total DT

سوف نتواصل معك قريبا ❤️
شكرا لاختيارك DST
");

$apiKey = "YOUR_API_KEY_HERE";

file_get_contents("https://api.callmebot.com/whatsapp.php?phone=$clientPhone&text=$message&apikey=$apiKey");

        echo "OK";
    } else {
        echo "ERROR";
    }

    $stmt->close();
    $conn->close();
}
?>
