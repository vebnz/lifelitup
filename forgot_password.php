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

if ($auth->isLoggedIn()) {
	header("Location: profile.php");
	die;
}

$template = $twig->loadTemplate('forgot_password.html');
$msg = isset($msg) ? $msg : '';
echo $template->render(array('msg' => $msg));

//require_once('footer.php');
$db->close();

?>
