<?php
/**
 * The template for displaying comments
 *
 * @package octotemplate
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php
	$args = array(
		'post_id' => get_queried_object_id(),
		'status' => 'approve',
		'orderby' => 'comment_date',
		'order' => 'ASC',
	);
	$comments = get_comments($args);
?>
<?php if($comments): ?>
	<?php foreach($comments as $comment): ?>
		<div>
			<p><?= $comment->comment_author ?></p>
			<p><?= $comment->comment_content ?></p>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<form action="/wp-comments-post.php" method="POST">
	<input type="text" placeholder="Ваше имя *" name="author" required>
	<input type="email" placeholder="Ваш E-mail *" name="email" required>
	<textarea name="comment" placeholder="Ваш комментарий" cols="30" rows="10"></textarea>
	<input type="hidden" name="comment_post_ID" value="<?= get_queried_object_id() ?>">
	<button>Отправить</button>
</form>