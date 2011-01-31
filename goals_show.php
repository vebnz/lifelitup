<?php
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

$table = tbl_goals;

require_once('twig/twig.php');
require_once('header.php');
require_once('functions/authenticate.php');
require_once('functions/todo.php');
require_once('functions/goals.php');
require_once('functions/comments.php');

if (!$auth->isLoggedIn()) {
	$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
	header("Location: login.php");
}

$show = $goals->show($_GET['id']);
$show_comments = $comments->show(tbl_goals, $_GET['id']);

$template = $twig->loadTemplate('goals_show.html');
echo $template->render(array('page_id' => $_GET['id'], 'goal' => $show, 'comments' => $show_comments, 'msg' => $msg));

$db->close();

?>
