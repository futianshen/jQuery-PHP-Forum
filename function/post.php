<?php
require_once('conn.php');
session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_POST['post_content'])) { 
    if ($user_id<1) { /* 訪客請註冊 */
        header('Location: ../index.html');
    }
    $post_content = $_POST['post_content'];
    $create_post = $conn->prepare("INSERT INTO posts VALUES(NULL, ?, CURRENT_TIMESTAMP, ?, 0)");
    $create_post->bind_param("is" ,$user_id ,$post_content);
    $create_post->execute() or die('error1'); 
    header('Location: ../forum.php');
}

?>