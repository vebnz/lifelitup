<?php
require_once('lib/Twig/Autoloader.php');

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(current_theme);
$twig = new Twig_Environment($loader);
$twig->addExtension(new Twig_Extension_Text());

require_once('people_online.php');
$twig->addGlobal('userid', $_SESSION['userid']);

?>
