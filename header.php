<?php
require_once('functions/authenticate.php');
require_once('functions/pages.php');

$logged_in = 1;

if ($auth->isLoggedIn()) {
	$logged_in = 0;
}

$showPages = $pages->createNavbar($logged_in);

$template = $twig->loadTemplate('header.html');
echo $template->render(array('title' => 'LifeLitUp', 'pages' => $showPages));
?>
