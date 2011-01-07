<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('header.php');
require_once('functions/blog.php');

$show = $blog->showAll();

$template = $twig->loadTemplate('content.html');
$username = isset($username) ? $username : '';
echo $template->render(array('posts' => $show, 'username' => $username));

$db->close();
?>
