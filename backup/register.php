<?php
require_once('includes/config.php');
require_once('database/db.php');
require_once('twig/twig.php');

$template = $twig->loadTemplate('register.html');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('functions/authenticate.php');

if ($auth->isLoggedIn()) {
        header("Location: profile.php");
}

$seed = sha1(rand(456, 25000) . 'We love pones bro' . (6*6));

echo $template->render(array('title' => 'Lifelitup', 'msg' => $msg, 'seed' => $seed));

$db->close();
?>
