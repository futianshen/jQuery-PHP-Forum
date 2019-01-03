<?php
require_once('conn.php');
$comment_id = $_POST['comment_id'];

session_start();
$username = $_SESSION['username'];

/* userid 直接 從 session 拿就不用 LEFT JOIN */
$update = $conn->prepare("UPDATE comments LEFT JOIN users ON comments.user_id = users.id  SET comments.is_deleted=1 WHERE comments.id=? AND users.username=?");
$update->bind_param("ss", $comment_id ,$username);
$update->execute() or die; 
?>