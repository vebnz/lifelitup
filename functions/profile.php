<?php
require_once('classes/profile.php');

$profile = new Profile;

if (isset($_POST['profile_edit'])) {
	// is user allowed to edit this data?
	$data['first_name'] = $_POST['first_name']; // secure
	$data['last_name'] = $_POST['last_name']; // secure
	$data['facebook'] = $_POST['facebook']; // secure
	$data['twitter'] = $_POST['twitter']; // secure
	$data['location'] = $_POST['location']; // secure
	$data['homepage'] = $_POST['homepage']; // secure
	$data['biography'] = $_POST['biography']; // secure

	$profile->update($data, $_SESSION['userid']);
	$msg = 'You have updated your profile.';
}

if ($_GET['action'] == 'confirm_email') {
	// do something
}

?>
