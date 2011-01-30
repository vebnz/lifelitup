<?php
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('twig/twig.php');
require_once('header.php');
require_once('functions/authenticate.php');

if ($auth->isLoggedIn()) {
	header("Location: profile.php");
}

// this is passed directly into an HTML text input, the text must be removed else registration will fail
$seed = sha1(rand(456, 25000) . 'We love ponies bro' . (6*6));
$msg = isset($msg) ? $msg : '';

if ($_GET['action'] == 'confirm') {
	$template = $twig->loadTemplate('confirm_email.html');
}
else {
	$template = $twig->loadTemplate('register.html');
}

echo $template->render(array('title' => 'Lifelitup', 'msg' => $msg, 'seed' => $seed));

$db->close();

?>
