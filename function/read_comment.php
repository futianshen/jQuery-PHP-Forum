<?php
$read_comment = $conn->prepare("SELECT comments.id, comments.created_at, users.nickname, users.username, comments.post_id, comments.user_id, comments.content FROM comments 
LEFT JOIN users ON comments.user_id = users.id 
WHERE post_id=? AND comments.is_deleted=0 
ORDER BY created_at DESC");

$read_comment->bind_param('i', $post_id); 
$read_comment->execute() or die("Error4");
$read_comment_result = $read_comment->get_result() or die; 
?>