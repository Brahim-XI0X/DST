<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DST Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

body{
  background:#FAF7F2;
  font-family: Arial;
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
}
h2{
    color: #F28C28;
}
form{
  background:white;
  padding:30px;
  border-radius:10px;
  box-shadow:0 5px 20px rgba(0,0,0,.1);
  text-align:center;
  min-width:300px;
}
div{
    display: flex;
    flex-direction: column;
    gap: 10px;
}

input{
  padding:10px;
  width:100%;
  border-radius:5px;
  border:1px solid #ccc;
}

button{
  padding:10px;
  width:100%;
  background:#1E1E1E;
  color:white;
  border-radius:5px;
  cursor:pointer;
}

button:hover{
  background:#F28C28;
}
</style>
</head>

<body>

<form method="post" action="auth.php">
  <h2>Admin Login</h2>

  <div>
    <input type="text" name="user" placeholder="Username" required>
    <input type="password" name="pass" placeholder="Password" required>
    <button>Login</button>
  </div>
</form>

</body>
</html>
