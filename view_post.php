<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('header.php');
require_once('functions/blog.php');

$show = $blog->showPost($_GET['id']);

$template = $twig->loadTemplate('view_post.html');
echo $template->render(array('title' => 'Lifelitup', 'posts' => $show));

require_once('footer.php');
$db->close();
?>
