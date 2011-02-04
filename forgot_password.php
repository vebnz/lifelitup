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
if ($_GET['action'] == 'reset') {
	$template = $twig->loadTemplate('new_password.html');
}
else {
	$template = $twig->loadTemplate('forgot_password.html');
}
$msg = isset($msg) ? $msg : '';
$code = isset($_GET['code']) ? $_GET['code'] : '';
$userid = isset($_GET['userid']) ? $_GET['userid'] : '';
$code = isset($code) ? $code : '';
$userid = isset($userid) ? $userid : '';
echo $template->render(array('msg' => $msg, 'code' => $code, 'userid' => $userid, 'isConfirmed' => $isConfirmed));

//require_once('footer.php');
$db->close();

?>
