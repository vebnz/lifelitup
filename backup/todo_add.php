<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$template = $twig->loadTemplate('todo_add.html');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('functions/authenticate.php');
require_once('functions/todo.php');
require_once('functions/goals.php');

if (!$auth->isLoggedIn()) {
	header("Location: login.php");
	die();
}

$showGoals = $goals->show();

echo $template->render(array('title' => 'Lifelitup', 'goals' => $showGoals, 'username' => $_SESSION['username'], 'msg' => $msg));

$db->close();
?>
