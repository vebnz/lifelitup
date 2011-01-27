<?php
require_once('classes/profile.php');

$profile = new Profile;

if (isset($_POST['profile_edit'])) {
	// is user allowed to edit this data?
	$data['first_name'] = $_POST['first_name']; // secure
	$data['last_name'] = $_POST['last_name']; // secure
	$data['facebook'] = $_POST['facebook']; // secure
	$data['twitter'] = $_POST['twitter']; // secure

	$profile->update($data, $_SESSION['userid']);
	$msg = 'You have updated your profile.';
}

if (isset($_GET['action']) == "add") {
	$id = (int)$_GET['friendid'];
	$userid = $_SESSION['userid'];
	
	$add = $profile->addFriend($id, $userid);        
	if ($add < 0) {
		$msg = 'Failed to add this friend to your friends list.';
		return;
	}
	
	if (empty($add)) {
		event::fire('USER_ADD_FRIEND');
		$msg = "Added friend successfully. <a href='profile.php?userid=" . $id . "'>View their profile</a>";
	}
	else {
		$msg = $add;
	}
	return $msg;

}

?>
