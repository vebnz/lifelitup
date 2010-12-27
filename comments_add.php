<?php
if (!$auth->isLoggedIn()) {
	die('not logged in');
}

if (!$comments) {
	die('comment class no initilised');
}

$
$template = $twig->loadTemplate('goals.html');
echo $template->render(array('title' => 'Lifelitup', 'goals' => $showGoals, 'username' => $_SESSION['username'], 'msg' => $msg));

require_once('footer.php');
$db->close();

?>
