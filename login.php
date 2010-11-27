<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('header.php');
require_once('functions/authenticate.php');

if ($_GET['action'] == 'logout') {
	$auth->logout();
	// this can definitely be improved. header() causes stuff to break
	echo '<meta http-equiv="refresh" content="0;url=login.php" />';
	die;
}

if ($auth->isLoggedIn()) {
	header("Location: profile.php");
	die;
}

$template = $twig->loadTemplate('login.html');
echo $template->render(array('msg' => $msg));

require_once('footer.php');
$db->close();
?>
