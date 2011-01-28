<?php
class Friends {
	function addFriend($id, $userid) {
		$db = Database::obtain();
		
		if ($this->checkHaveAlready($id, $userid) == true) {
			$msg = 'You are already friends with this person!';
			return $msg;
		}

		if ($this->checkFriendExists($id) == false) {
			$msg = 'This memeber does not exist.';
			return $msg;
		}
		
		$data['user_id'] = $userid;
		$data['friend_id'] = $id;
		$data['date'] = time();
		$data['verified'] = 0;

		$pid = $db->insert(tbl_friends, $data);
	}
	
	function removeFriend($friendid, $userid) {
		$db = Database::obtain();
		
		if ($this->checkHaveAlready($id, $userid) == false) {
			$msg = 'You are not currently friends with this person silly';
			return $msg;
		}
		
		if ($this->checkFriendExists($friendid) == false) {
			$msg = 'This user doesn\'t exist in our system';
			return $msg;
		}		
		
		$sql = "DELETE FROM " . tbl_friends . " WHERE user_id = " . (int)$userid . " AND friend_id = " . (int)$friendid . " WHERE verified = '1'";
		$q = $db->query($sql);
		if ($q > 0)
		{
			$sqlRemFriend = "DELETE FROM " . tbl_friends . " WHRER friend_id = " . (int)$userid . " AND user_id = " . (int)$friendid;
			$q = $db->query($sqlRemFriend);
		}
		else
		{
			$sqlIndFriend = "DELETE FROM " . tbl_friends . " WHERE user_id = " . (int)$userid . " AND friend_id = " . (int)$friendid;
			$q = $db->query($sqlIndFriend);
		}
		
	}
	
	function checkFriendExists($id) {
		$db = Database::obtain();

		$sql = "SELECT user_id
			FROM " . tbl_profile . "
			WHERE user_id = " . (int)$id;
		$row = $db->query_first($sql);

		if (!empty($row)) {
			return true;
		}
	
		return false;
	}

	function checkHaveAlready($id, $userid) {
		$db = Database::obtain();

		$sql = "SELECT friend_id
			FROM " . tbl_friends . "
			WHERE friend_id = " . (int)$id . "
			AND user_id = " . (int)$userid;
		$row = $db->query_first($sql);
		
		if ($row > 0) {
			return true;
		}

		return false;
	}
		
	function getFriends($userid) {
		$db = Database::obtain();
		
		$sql = "SELECT " . tbl_users . ".id, " . tbl_users . ".email, " . tbl_profile . ".first_name, " . tbl_profile . ".last_name, " . tbl_profile . ".twitter, " . tbl_profile . ".facebook
		        FROM " . tbl_friends . "
        		JOIN " . tbl_users ." ON " . tbl_friends . ".friend_id = " . tbl_users . ".id
       			JOIN " . tbl_profile . " ON " . tbl_friends . ".friend_id = " . tbl_profile . ".user_id
        		WHERE " . tbl_friends . ".user_id =  " . $userid;
		$friends = $db->fetch_array($sql);

		return $friends;
		
	}
	
	function checkIsFriend($userid) {
		$db = Database::obtain();
		
		$sql = "SELECT friend_id
				FROM " . tbl_friends . "
				WHERE friend_id = " . (int)$userid . " AND user_id = " . $_SESSION['userid'];
		
		$pid = $db->query_first($sql);
		
		if ($pid > 0)
		{
			return true;
		}
		
		return false;
		
	}
}
?>
