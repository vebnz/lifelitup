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
	$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
	header("Location: login.php");
}

if (isset($_GET['place'])) {
	// not secure
	$showGoals = $goals->showByPlace($_SESSION['userid'], $_GET['place']);
}
else if (isset($_GET['country'])) {
	// ns
	$showGoals = $goals->showByCountry($_SESSION['userid'], $_GET['country']);
}
else if (isset($_GET['region'])) {
	// ns
	$showGoals = $goals->showByRegion($_SESSION['userid'], $_GET['region']);
}
else {
	$showGoals = $goals->showAll($_SESSION['userid']);
}

$showCategories = $goals->showCategories();

$template = $twig->loadTemplate('goals.html');
echo $template->render(array('goals' => $showGoals, 'categories' => $showCategories, 'msg' => $msg));

$db->close();

?>
