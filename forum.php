<?php
require_once('function/conn.php');
require_once('function/user_info.php');
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
	<title>記錄 Record</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css"> 
	<link rel="stylesheet" href="./css/forum.css">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="./js/main.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand">Record 記錄</a>
		<?require_once('function/nav.php')?>
	</nav>

	<main class="forum container">
		<div class="info jumbotron">
			<h1>嗨！<?if(isset($user_nick))echo htmlspecialchars($user_nick, ENT_QUOTES, 'utf-8');else echo 'Stranger' ?> 有什麼話想說嗎？</h1> 
			<hr>
			<form action="function/post.php" method="POST">
				<label><textarea name="post_content" required="required" placeholder="快記下你的奇思妙想、靈光乍現！"></textarea></label>
				<input type="submit" value="分享" class="btn btn-primary btn-lg">
			</form>
		</div>  
            
<?php
require_once('function/read_post.php');
if ($read_post_result->num_rows >0) {
	while ($read_post_row = $read_post_result->fetch_array()) {
		$post_author = $read_post_row['nickname']; 
		$post_time = $read_post_row['created_at'];
		$post_username = $read_post_row['username'];
		$post_id = $read_post_row['id']; 
		$post_content = $read_post_row['content'];
		$post_user_id = $read_post_row['user_id']
?>

		<div class="post card border-dark">
			<div class="post__head card-header">
				<div class="post__info">
					<div><?=htmlspecialchars($post_author ,ENT_QUOTES, 'utf-8')?></div>
					<div><?=$post_time?></div>
				</div>
				<div class="update update__post">

<?  if(isset($username) && $username===$post_username) { ?>

					<form class="update__post--del" action="function/del_post.php" method="POST">
						<input type="hidden" checked="checked" name="post_id" value="<?echo $post_id?>">
						<input type="submit" value="刪除" class='btn btn-danger'>
					</form>
					<form class="update__post--modify"  action="function/modify_post.php" method="POST"> 
						<input type="hidden" checked="checked" name="post_id" value="<?echo $post_id?>" >
						<input type="submit" value="修改" class='btn btn-warning'> 
					</form>    

<?  } ?>

				</div>
			</div>

			<div class="post__body card-body">
				<p class="post__content card-text"><?echo htmlspecialchars($post_content ,ENT_QUOTES, 'utf-8')?></p>
				
				<form class="input__comment" action="function/comment.php" method="POST">
					<label>
						<textarea name="comment_content" required="required" placeholder="讓我們的思緒互相連接"></textarea>
					</label>
					<input type="hidden" name="post_id" value="<?echo $post_id?>">
					<input type="submit" value="連接" class="btn btn-success">
				</form>
				
				<div class="comment">          
                    
<?php
		require('function/read_comment.php');
		if ($read_comment_result->num_rows >0) {
			while ($read_comment_row = $read_comment_result->fetch_assoc()) { 
				$comment_id = $read_comment_row['id'];
				$comment_nickname = $read_comment_row['nickname'];
				$comment_time = $read_comment_row['created_at'];
				$comment_username = $read_comment_row['username'];
				$comment_content = $read_comment_row['content'];
				$comment_user_id = $read_comment_row['user_id'];
?>
					<div class="comment__read <?if($post_user_id===$comment_user_id) echo' text-white bg-danger'; else echo 'border-primary'?> card">
						<div class="comment__read--header card-header">
							<div class="comment__read--info">
								<div><?echo htmlspecialchars($comment_nickname ,ENT_QUOTES, 'utf-8') ?></div>
								<div><?echo $comment_time ?></div>
							</div>
							<div class="update update__comment">

		<?  if(isset($username) && $username===$comment_username) { ?>    
            
								<form class="update__comment--del" action="function/del_comment.php" method="POST"> 
									<input type="hidden" checked="checked" name="comment_id" value="<?echo $comment_id?>" >
									<input type="submit" value="刪除" class='btn btn-danger'> 
								</form>
								<form class="update__comment--modify" action="function/modify_comment.php" method="POST"> 
									<input type="hidden" checked="checked" name="comment_id" value="<?echo $comment_id?>" >
									<input type="submit" value="修改" class='btn btn-warning'>
								</form>

		<?  } ?>

							</div>
						</div>
						<div class="comment__read--main card-body">
								<p class="comment__read--content card-text"><?echo htmlspecialchars($comment_content ,ENT_QUOTES, 'utf-8') ?></p>    
						</div>
					</div>

<?		} 
    }   ?>
				</div>
			</div>
		</div>

<?}
} ?> 

	</main>

<?  
if($page_quantity>1) { 
?>

	<div class="page">
		<ul class="btn-toolbar btn-group">
			<li><a class="btn btn-secondary" href="forum.php?page=1">&laquo;</a></li>

<?for ($i=1; $i<$page_quantity; $i++) if ($page-1<=$i && $i<=$page+1) echo "<li><a href=?page=$i class='btn btn-secondary'>$i</a></li> " ?>

			<li><a class="btn btn-secondary" href="forum.php?page=<?=$page_quantity?>">&raquo;</a></li>
		</ul>
	</div>

<?} ?>

<?php require_once('function/html_footer.html')?>
</body>
</html>