<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$template = $twig->loadTemplate('login.html');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('functions/authenticate.php');

if ($_GET['action'] == 'logout') {
	$auth->logout();
}

if ($auth->isLoggedIn()) {
	header("Location: profile.php");
}

echo $template->render(array('title' => 'Lifelitup', 'msg' => $msg));

$db->close();
?>
