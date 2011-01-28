<?php
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('twig/twig.php');
require_once('header.php');
require_once('functions/authenticate.php');
require_once('functions/todo.php');
require_once('functions/goals.php');

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

if ($_GET['catid'] > 0) {
	$categoryid = intval($_GET['catid']);
	$showGoals = $todo->show($userid, $categoryid);
	$categoryName = $todo->getCategoryName($categoryid);
}	

$showCategories = $todo->showTodoCategories($userid);

$template = $twig->loadTemplate('todo.html');
echo $template->render(array('not_me' => $not_me, 'goals' => $showGoals, 'categories' => $showCategories, 'categoryName' => $categoryName));

$db->close();
?>
