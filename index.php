<?php
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('twig/twig.php');
require_once('header.php');
require_once('functions/blog.php');

//$show = $blog->showAll();

$template = $twig->loadTemplate('content.html');
$username = isset($username) ? $username : '';
echo $template->render(array('posts' => $show));

$db->close();
?>
