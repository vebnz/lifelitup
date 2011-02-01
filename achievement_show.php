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
require_once('functions/achievements.php');
require_once('functions/friends.php');
require_once('functions/profile.php');

if (!$auth->isLoggedIn()) {
	$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
	header("Location: login.php");
}

if ($_GET['userid'] == $_SESSION['userid']) {
	$isViewing = true;
}

$goal = $goals->show($_GET['id']);
$achievements = $achievement->show($_GET['id'], $_GET['userid']);
$isFriend = $friends->checkIsFriend($_GET['userid'], $_SESSION['userid']);
$privSetting = $profile->getPrivacySettings($_GET['userid']);

$template = $twig->loadTemplate('achievements_show.html');
echo $template->render(array('goal' => $goal, 'achievement' => $achievements, 'msg' => $msg, 'isFriend' => $isFriend, 'privacy' => $privSetting, 'isViewing' => $isViewing));

$db->close();

?>