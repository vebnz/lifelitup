<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$template = $twig->loadTemplate('todo.html');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('functions/authenticate.php');
require_once('functions/todo.php');

if (!$auth->isLoggedIn()) {
	header("Location: login.php");
	die();
}

$userid = $_SESSION['userid'];
$goals = $todo->show($userid);

echo $template->render(array('title' => 'Lifelitup', 'goals' => $goals, 'username' => $_SESSION['username']));

$db->close();
?>
