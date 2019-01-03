<?php
require_once('conn.php');
$post_id = $_POST['post_id'];
session_start();
$username = $_SESSION['username']; 

/* userid 直接 從 session 拿就不用 LEFT JOIN */
$update = $conn->prepare("UPDATE posts LEFT JOIN users ON posts.user_id = users.id SET posts.is_deleted=1 WHERE posts.id=? AND users.username=? ");
$update->bind_param("is", $post_id ,$username);
$update->execute() or die;
?>
