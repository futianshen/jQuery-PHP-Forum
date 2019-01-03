<?php
require_once('conn.php');
session_start();

/* create comment */
if (isset($_SESSION['user_id']) && isset($_POST['post_id']) && isset($_POST['comment_content'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $comment_content = $_POST['comment_content'];

    $create_comment = $conn->prepare("INSERT INTO comments VALUES(NULL, CURRENT_TIMESTAMP, ?, ?, ?, 0)");
    $create_comment->bind_param("iis", $user_id, $post_id, $comment_content);
    $create_comment->execute();

    /* read post_user_id */
    $read_post = $conn->prepare("SELECT posts.user_id FROM posts WHERE id=?");
    $read_post->bind_param("i", $post_id);
    $read_post->execute() or die;
    $read_post_result = $read_post->get_result();
    $read_post_row = $read_post_result->fetch_assoc();
    $post_user_id = $read_post_row['user_id'];

    /* prepare comment to front-end */
    $read_comment = $conn->prepare("SELECT comments.id, comments.created_at, comments.user_id, users.nickname 
    FROM comments LEFT JOIN users ON comments.user_id = users.id 
    ORDER BY comments.id DESC");
    $read_comment->execute();
    $read_comment_result = $read_comment->get_result();
    $read_comment_row = $read_comment_result->fetch_array();
    $comment_nickname=$read_comment_row['nickname'];
    $comment_time=$read_comment_row['created_at'];
    $comment_id = $read_comment_row['id'];
    $conn->close(); 

    /* send response to front-end */
    if (isset($_SESSION['user_id'])) { 
        $arr = array( 
            'result' => 'success',
            'highlight' => $post_user_id===$user_id,
            'comment_id' => $comment_id,
            'comment_nickname' => $comment_nickname,
            'comment_time' => $comment_time 
        ); 
    }
    echo json_encode($arr); /* 要 echo 才行 */
} else {
    $arr = array(
        'result' => 'signup'
    );
    echo json_encode($arr); 
}
?> 