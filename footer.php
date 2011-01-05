<?php
require_once('functions/people.php');

$template = $twig->loadTemplate('footer.html');

$ip = $_SERVER['REMOTE_ADDR'];

if ($ip > 0) {
    if (!$people->exists($ip)) {
            $people->insert($ip);
    }
    else {
            $people->update($ip);
    }
}

$people->truncate();

$online = $people->online() * rand(7,14);

echo $template->render(array('people_online' => $online));
?>
