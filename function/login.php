<?php
require_once('conn.php');
session_start();/* session 可以定時嗎 ？或者說需要定時嗎？如果說 session 沒有刪除，就是一直保持登入狀態 ？ 有預設*/
$username = $_POST['username'];
$password = $_POST['password'];

$read = $conn->prepare( "SELECT * FROM users WHERE username=? ");
$read->bind_param("s" ,$username); 
$read->execute();
$read_result = $read->get_result();
$read_row = $read_result->fetch_assoc();

$hash = $read_row['password']; 
$user_id = $read_row['id'];
$user_nick = $read_row['nickname'];

if (password_verify($password, $hash)) {
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id; 
    setcookie("user_nick", $user_nick, time()+3600*24, "/");
    header('Location: ../forum.php'); 
} else {
    header('Location: ../index.html');
}
?>