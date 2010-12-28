<?php
require_once('/home/life/public_html/classes/comments.php');

$comments = new Comments;

if (isset($_POST['post_comment'])) {

	if (!$auth) {
		die('cannot auth');
	}

	if (!$auth->isLoggedIn()) {
		$msg = 'Sorry, you\'re not logged in, so you can\'t post a new comment.';
		return;
	}
	
	$userid = (int)$_SESSION['userid'];
	$pageid = (int)$_POST['page_id'];
	$table = (int)$_POST['module_id'];
	$content = $_POST['content']; // secure

	if (empty($userid)) {
		$msg = 'I couldn\'t find your userid!';
		return;
	}

	if (empty($pageid)) {
		$msg = 'The page identification number was not found.';
		return;
	}

	if (empty($content)) {
		$msg = 'You can\'t just leave your comment empty, nobody can read it.';
		return;
	}

	if (strlen($content) <= 3) {
		$msg = 'Your comment should ideally be over 4 characters long...';
		return;
	}

	if (empty($table)) {
		$msg = 'You need to include the table';
		return;
	}

	switch ($table) {
		case 1:
			$table = tbl_blog;
			break;
		case 2:
			$table = tbl_goals;
			break;
	}

	$add = $comments->add($userid, $pageid, $table, $content);
	if (!empty($add)) {
		$msg = 'Thank you for adding your comment ' . $_SESSION['username'];
	}
}

?>
