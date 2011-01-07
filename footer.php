<?php
require_once('functions/people.php');

$ip = getIP();
if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/', $ip)) {
	if (!$people->exists($ip)) {
    	$people->insert($ip);
	}
	else {
    	$people->update($ip);
	}
}

$people->truncate();

$ucount = $people->user_count() + 200;
$online = $people->online() + 100;

$template = $twig->loadTemplate('footer.html');
echo $template->render(array('user_count' => $ucount, 'people_online' => $online));
?>
