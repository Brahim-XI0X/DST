<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if ($_POST["user"] === "admin" && $_POST["pass"] === "1234") {
  $_SESSION["admin"] = true;
  header("Location: dashboard.php");
} else {
  echo "Access denied";
}
