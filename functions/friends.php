<?php
require_once('classes/friends.php');
	
$friends = new Friends;

if (isset($_GET['action']) == "add") {
	$id = (int)$_GET['friendid'];
	$userid = $_SESSION['userid'];
	
	$add = $friends->addFriend($id, $userid);        
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

if (isset($_GET['action']) == "remove") {
	die();
	$id = (int)$_GET['friendid'];
	$userid = $_SESSION['userid'];
	
	$remove = $friends->removeFriend($id, $userid);        
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
	
?>