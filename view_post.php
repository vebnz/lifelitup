<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('header.php');
require_once('functions/blog.php');
require_once('functions/comments.php');

$show = $blog->showPost($_GET['id']);
$show_comments = $comments->show($_GET['id']);

$template = $twig->loadTemplate('view_post.html');
echo $template->render(array('page_id' => $_GET['id'], 'posts' => $show, 'comments' => $show_comments));

require_once('footer.php');
$db->close();
?>
