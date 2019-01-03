<?php
$read_post = $conn->prepare("SELECT is_deleted FROM posts WHERE is_deleted=0 ");
$read_post->execute() or die("Error2"); 
$read_post_result = $read_post->get_result();

$post_quantity = $read_post_result->num_rows;
$per_page = 10;

$page_quantity = ceil($post_quantity/$per_page); 

if (!isset($_GET['page'])) $page =1; 
else $page = intval($_GET["page"]); 
$skip = ($page-1)*$per_page; 

$read_post =$conn->prepare("SELECT posts.id, posts.user_id, posts.created_at, posts.content, users.nickname, users.username FROM posts 
LEFT JOIN users ON posts.user_id = users.id 
WHERE posts.is_deleted=0 ORDER BY created_at DESC 
LIMIT ?, ? ");
$read_post->bind_param("ii", $skip, $per_page);
$read_post->execute();
$read_post_result = $read_post->get_result() or die("Error3");
?>