<?php
require_once('conn.php');
$post_id=$_POST['post_id'];
$modify_content=$_POST['modify_content'];

session_start();
$username = $_SESSION['username'];

/* userid 直接 從 session 拿就不用 LEFT JOIN */
$update = $conn->prepare("UPDATE posts LEFT JOIN users ON posts.user_id = users.id SET posts.content=? WHERE posts.id=? AND users.username=? ");
$update->bind_param("sis", $modify_content, $post_id, $username);
$update->execute() or die;
$arr = array( 
  'result' => 'success'
);

echo json_encode($arr);
?>