<?php
require_once('includes/config.php');
require_once('database/db.php');
// twig 
require_once('twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(current_theme);
$twig = new Twig_Environment($loader);
// end twig
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
