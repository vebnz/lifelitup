<?php
require_once('/home/life/public_html/classes/comments.php');

$comments = new Comments;

if (isset($_POST['post_comment'])) {	
	$userid = (int)$_SESSION['userid'];
	$pageid = (int)$_POST['pageid'];
	$content = $_POST['content']; // secure

	$add = $comments->add($userid, $pageid, $content);
	echo $add;
}

?>
