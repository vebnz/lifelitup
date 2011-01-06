<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('header.php');
require_once('functions/admin/user.php');

$userRows = $users->getAllUsers();

$template = $twig->loadTemplate('adminuser.html');
echo $template->render(array('title' => 'Lifelitup', 'users' => $userRows));

/*foreach ($userRows as $record) {
	echo $record['username'] . "<br />";
}*/

require_once('footer.php');
$db->close();
?>
