<?php
require_once('classes/profile.php');

$profile = new Profile;

$profile->exists($_SESSION['userid']);

?>
