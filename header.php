<?php
require_once('functions/authenticate.php');
require_once('functions/pages.php');

// this is just to get pages based on your status (logged in/out)
$logged_in = 1;

if ($auth->isLoggedIn()) {
	$logged_in = 0;
	$username = $_SESSION['username'];
}

/*$showPages = $pages->createNavbar($logged_in);

$template = $twig->loadTemplate('header.html');
echo $template->render(array('title' => 'LifeLitUp', 'pages' => $showPages));
*/
?>
