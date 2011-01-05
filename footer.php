<?php
require_once('functions/people.php');

$template = $twig->loadTemplate('footer.html');

$ip = getIP();

// make sure IP is right before doing anything with it...
if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/', $ip)) {
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
