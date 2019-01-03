<?php
require_once('conn.php');
session_start();
$user_id = $_SESSION['user_id'];
session_unset();
session_destroy();

setcookie("user_nick", '', time()-3600*24, "/");
header('Location: ../');
?>

