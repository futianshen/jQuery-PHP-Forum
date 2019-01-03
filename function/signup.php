<?php 
require_once ('conn.php');
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $nickname = $_POST['nickname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $sql = $conn->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, 0)");
    $sql->bind_param("sss", $username, $password, $nickname);
    $sql->execute() or die('error1');
    header('Location: ../index.html');
}
?>