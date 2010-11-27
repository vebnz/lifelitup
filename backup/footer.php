<?php
$template = $twig->loadTemplate('footer.html');

echo $template->render(array('people_online' => 500));
?>
