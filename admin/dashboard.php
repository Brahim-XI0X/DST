<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* حماية */
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

/* اتصال قاعدة البيانات */
include __DIR__ . '/../config/db.php';

/* جلب البيانات */
$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DST Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<a href="logout.php" class="logout">Logout</a>

<h1>DST Orders Dashboard</h1>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Service</th>
    <th>USD</th>
    <th>Total (DT)</th>
    <th>Status</th>
    <th>Date</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row["id"] ?></td>
    <td><?= htmlspecialchars($row["name"]) ?></td>
    <td><?= htmlspecialchars($row["phone"]) ?></td>
    <td><?= htmlspecialchars($row["service"]) ?></td>
    <td><?= $row["usd"] ?></td>
    <td><?= $row["total"] ?></td>
    <td class="<?= $row["status"] === "Done" ? "status-done" : "status-pending" ?>">
      <?= $row["status"] ?>
    </td>
    <td><?= $row["created_at"] ?></td>
<th>Actions</th>

    <td>
  <button onclick="changeStatus(<?= $row['id'] ?>)" style="background:green;color:white;border:none;padding:5px 10px;border-radius:5px;">
    Done
  </button>

  <button onclick="deleteOrder(<?= $row['id'] ?>)" style="background:red;color:white;border:none;padding:5px 10px;border-radius:5px;">
    Delete
  </button>
</td>

  </tr>
  <?php endwhile; ?>

</table>

<?php
$result = $conn->query("SELECT * FROM contact ORDER BY id DESC");
?>

<h2>Contact Messages</h2>
<table border="1" cellpadding="10">
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Email</th>
  <th>Phone</th>
  <th>Message</th>
  <th>Date</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
  <td><?php echo $row['id']; ?></td>
  <td><?php echo $row['fullname']; ?></td>
  <td><?php echo $row['email']; ?></td>
  <td><?php echo $row['phone']; ?></td>
  <td><?php echo $row['message']; ?></td>
  <td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>

</table>


<style>
    body {
      font-family: Arial, sans-serif;
      background: #FAF7F2;
      padding: 30px;
    }

    h1 {
      color: #F28C28;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    th {
      background: #1E1E1E;
      color: white;
    }

    tr:hover {
      background: #f2f2f2;
    }

    .status-pending {
      color: orange;
      font-weight: bold;
    }

    .status-done {
      color: green;
      font-weight: bold;
    }

    .logout {
      display: inline-block;
      margin-bottom: 20px;
      color: white;
      background: #1E1E1E;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 5px;
    }

    .logout:hover {
      background: #F28C28;
    }
</style>




<script>
function changeStatus(id) {
  let form = new FormData();
  form.append("id", id);

  fetch("change_status.php", { method: "POST", body: form })
  .then(r => r.text())
  .then(() => {
    alert("Status Updated ✅");
    location.reload();
  });
}

function deleteOrder(id) {
  if(!confirm("Delete this order?")) return;

  let form = new FormData();
  form.append("id", id);

  fetch("delete_order.php", { method: "POST", body: form })
  .then(r => r.text())
  .then(() => {
    alert("Order Deleted ❌");
    location.reload();
  });
}
function notify(msg,color){
  let box = document.createElement("div");
  box.innerHTML = msg;
  box.style.position="fixed";
  box.style.top="20px";
  box.style.right="20px";
  box.style.padding="12px 18px";
  box.style.background=color;
  box.style.color="white";
  box.style.borderRadius="6px";
  document.body.appendChild(box);
  setTimeout(()=> box.remove(),2500);
}

</script>

</body>
</html>
