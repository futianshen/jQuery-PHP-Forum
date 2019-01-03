<?php
session_start();
if(isset($_COOKIE['user_nick']) && $_SESSION['user_id'] && $_SESSION['username']) {
  $user_nick = $_COOKIE['user_nick'];
  $user_id = $_SESSION['user_id']; 
  $username = $_SESSION['username'];
}
?>