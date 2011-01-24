<?php
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('twig/twig.php');
require_once('header.php');
require_once('functions/authenticate.php');
require_once('functions/achievements.php');
require_once('functions/friends.php');
require_once('functions/profile.php');

if (!$auth->isLoggedIn()) {
	header("Location: login.php");
	die;
}

if (isset($_GET['userid'])) {
	$userid = intval($_GET['userid']);
}
else {
	$userid = $_SESSION['userid'];
}

if ($userid != $_SESSION['userid']) {
	$viewing = true;
}

$achievements = $achievement->getAchievements($userid);
$friends = $friends->getFriends($userid);
$profileArr = $profile->get($userid);

$template = $twig->loadTemplate('profile.html');
echo $template->render(array('msg' => $msg, 'profile' => $profileArr, 'achievements' => $achievements, 'friends' => $friends, 'viewing' => $viewing));

$db->close();

?>
