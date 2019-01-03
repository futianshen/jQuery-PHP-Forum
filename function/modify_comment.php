<?php
require_once('conn.php');
$comment_id =$_POST['comment_id'];
$comment_content = $_POST['modify_content'];

session_start(); 
$username = $_SESSION['username'];

/* userid 直接 從 session 拿就不用 LEFT JOIN */
$update = $conn->prepare("UPDATE comments LEFT JOIN users ON comments.user_id = users.id SET comments.content=? WHERE comments.id=? AND users.username=? ");
$update->bind_param("sis", $comment_content, $comment_id ,$username);
$update->execute();
$arr = array( 
    'result' => 'success'
);
echo json_encode($arr);
?>
