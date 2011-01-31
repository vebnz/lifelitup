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
require_once('functions/gravatar.php');

if (!$auth->isLoggedIn()) {
	$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
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
	$isViewing = true;
	$isFriend = $friends->checkIsFriend($userid, $_SESSION['userid']);
}

$achievements = $achievement->getAchievements($userid);
$friends = $friends->getFriends($userid);
$profileArr = $profile->get($userid);
$activities = $profile->getActivities($userid);
$latestStatus = $profile->getLatestStatus($userid);

if ($_GET['action'] == 'modify') {
	if ($isViewing) {
		event::fire('HACK_PROFILE_EDIT');
		header("Location: profile.php");
	}
	$template = $twig->loadTemplate('profile_edit.html');
}
elseif (empty($profileArr['first_name'])) {
	header("Location: profile.php?action=modify");
} else {
	$template = $twig->loadTemplate('profile.html');
}

echo $template->render(array('msg' => $msg, 'profile' => $profileArr, 'achievements' => $achievements, 'friends' => $friends, 'isFriend' => $isFriend, 
							 'activities' => $activities, 'isViewing' => $isViewing, 'isEditing' => $isEditing, 'latestStatus' => $latestStatus,
							 'avatar' => get_gravatar($profileArr['email'])));

$db->close();

?>
