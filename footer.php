<?php
$template = $twig->loadTemplate('footer.html');

$online = 500;

echo $template->render(array('people_online' => $online));
?>
