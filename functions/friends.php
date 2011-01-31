<?php
require_once('classes/friends.php');
	
$friends = new Friends;

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == "add") {
	$id = (int)$_GET['friendid'];
	$userid = $_SESSION['userid'];
	
	$add = $friends->addFriend($id, $userid);        
	if ($add < 0) {
		$msg = 'Failed to add this friend to your friends list.';
		return;
	}
	
	if (empty($add)) {
		event::fire('USER_ADD_FRIEND');
		$msg = "An email has been sent to your friend for confirmation!";
		$friends->sendFriendVerification($userid, $id);
	}
	else {
		$msg = $add;
	}
	return $msg;
}	

if ($action == "remove") {
	$id = (int)$_GET['friendid'];
	$userid = $_SESSION['userid'];
	
	$add = $friends->removeFriend($id, $userid);        
	if ($remove < 0) {
		$msg = 'Failed to remove this friend from your friends list.';
		return;
	}
	
	if (empty($remove)) {
		event::fire('USER_REMOVE_FRIEND');
		$msg = "Removed friend successfully.";
	}
	else {
		$msg = $add;
	}
	return $msg;
}

if ($action == "confirmFriend") {

	$id = $_GET['friendid'];
	$userid = $_GET['userid'];
	
	$conf = $friends->verifyFriend($userid, $id);
	if ($conf < 0) {
		$msg = 'Failed to verify this friendship.';
		return;
	}
	
	if (empty($conf)) {
		event::fire('USER_CONFIRM_FRIEND');
		$msg = "You are now friends with this person. View their <a href='profile.php?userid=" . $id . "'>profile</a>."; 
	}
	else
	{
		$msg = $conf;
	}
	return $msg;
}	
	
?>
