<?php
$db_hostname = "localhost"; 
$db_username = "tian";
$db_password = "u+%FpfR=8Pp2RF4$"; 
$db_name = "record";
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
if ($conn->connect_error) die("連接失敗: " . $conn->connect_error);
$conn->query("SET NAMES 'UTF8'"); 
$conn->query("SET time_zone = '+08:00'"); 
?>

