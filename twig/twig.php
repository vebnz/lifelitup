<?php
require_once('lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(current_theme);
$twig = new Twig_Environment($loader);

?>
