<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('classes/log.php');
require_once('classes/event.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('twig/twig.php');
require_once('header.php');
require_once('functions/authenticate.php');

if(key_exists('action',$_GET)) {
	if ($_GET['action'] == 'logout') {
		event::fire('USER_LOGOUT');
		$auth->logout();
		// this can definitely be improved. header() causes stuff to break
		echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		die;
	}
}

if ($auth->isLoggedIn()) {
	header("Location: profile.php");
	die;
}

$_SESSION['destination'] = $_SERVER['HTTP_REFERER'];

$template = $twig->loadTemplate('login.html');
$msg = isset($msg) ? $msg : '';
echo $template->render(array('msg' => $msg, 'dest' => $dest));

//require_once('footer.php');
$db->close();
?>
