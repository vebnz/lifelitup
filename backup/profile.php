<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('functions/authenticate.php');

if (!$auth->isLoggedIn()) {
	header('Location: login.php');
	die();
}

$username = $_SESSION['username'];

$template = $twig->loadTemplate('profile.html');
echo $template->render(array('title' => 'Lifelitup', 'username' => $username));

$db->close();
?>
