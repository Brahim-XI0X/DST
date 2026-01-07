<?php
session_start();
session_destroy();
header("Location: login.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>