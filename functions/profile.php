<?php
require_once('classes/profile.php');

$profile = new Profile;

if (isset($_POST['profile_edit'])) {
	$data['first_name'] = $_POST['first_name']; // secure
	$data['last_name'] = $_POST['last_name']; // secure
	$data['facebook'] = $_POST['facebook']; // secure
	$data['twitter'] = $_POST['twitter']; // secure

	$profile->update($data, $_SESSION['userid']);
	$msg = 'You have updated your profile.';
}

$profileArr = $profile->get($_SESSION['userid']);
?>
