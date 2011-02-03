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

$userid = $_SESSION['userid'];
$isSearching = true;

if (isset($_GET['place'])) {
	// not secure
	$showGoals = $goals->showByPlace($userid, $_GET['place']);
	$showCategories = array(0 => array('id' => 1, 'name' => $_GET['place']));
}
else if (isset($_GET['country'])) {
	// ns
	$showGoals = $goals->showByCountry($userid, $_GET['country']);
	$showCategories = array(0 => array('id' => 1, 'name' => $_GET['country']));
}
else if (isset($_GET['region'])) {
	// ns
	$showGoals = $goals->showByRegion($userid, $_GET['region']);
	$showCategories = array(0 => array('id' => 1, 'name' => $_GET['region']));
}
else if (isset($_GET['s'])) {
	// ns
	$showGoals = $goals->searchGoals($userid, $_GET['s']);
	$showCategories = array(0 => array('id' => 1, 'name' => $_GET['s']));
}
else {
	$showCategories = $goals->showCategories($userid);
	$showGoals = $goals->showAll($userid);
	$isSearching = false;
}

$template = $twig->loadTemplate('goals.html');
echo $template->render(array('goals' => $showGoals, 'categories' => $showCategories, 'msg' => $msg, 'isSearching' => $isSearching));

$db->close();

?>
