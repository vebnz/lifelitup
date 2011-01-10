<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('header.php');
require_once('functions/authenticate.php');
require_once('functions/todo.php');
require_once('functions/goals.php');

if (!$auth->isLoggedIn()) {
	header("Location: login.php");
}

$showGoals = $goals->showAll();

$template = $twig->loadTemplate('goals.html');
echo $template->render(array('title' => 'Lifelitup', 'goals' => $showGoals, 'username' => $_SESSION['username'], 'msg' => $msg));

$db->close();

?>
