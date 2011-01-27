<?php
require_once('lib/Twig/Autoloader.php');
require_once('/classes/profile.php');

$profile = new Profile;
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(current_theme);
$twig = new Twig_Environment($loader);
$twig->addExtension(new Twig_Extension_Text());


// twig globals
require_once('people_online.php');
$twig->addGlobal('userid', $_SESSION['userid']);
?>
