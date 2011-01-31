<?php
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('twig/twig.php');
require_once('header.php');
require_once('functions/authenticate.php');
require_once('functions/goals.php');
require_once('functions/achievements.php');

if (!$auth->isLoggedIn()) {
	$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
	header("Location: login.php");
}

if ($_GET['userid'] > 0) {
	// this is for the template file to change between (you) and the userid provided
	$not_me = 1;
	$userid = $_GET['userid'];
}
else {
	$userid = $_SESSION['userid'];
}

$show = $goals->show($_GET['id']);
$template = $twig->loadTemplate('completion.html');
echo $template->render(array('page_id' => $_GET['id'], 'not_me' => $not_me, 'goal' => $show));

$db->close();
?>
