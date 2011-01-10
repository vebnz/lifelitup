<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('header.php');
require_once('functions/authenticate.php');
require_once('functions/todo.php');

if (!$auth->isLoggedIn()) {
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

$goals = $todo->show($userid);

$template = $twig->loadTemplate('todo.html');
echo $template->render(array('not_me' => $not_me, 'goals' => $goals, 'username' => $auth->getUsername($userid)));

$db->close();
?>
