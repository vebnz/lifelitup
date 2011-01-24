<?php
class Friends {
	function add($friendid) {
		$db = Database::obtain();
		
		$data["user_id"] = (int)$_SESSION['userid'];
		$data["friend_id"] = (int)$friendid;
		
		if ($this->checkHaveFriendAlready($friendid) == true) {
			$msg = 'This person is your friend already';
			return $msg;
		}
		
		if ($this->checkFriendExists($friendid) == false) {
			$msg = 'This user doesn\'t exist in our system';
			return $msg;
		}
		
		$pid = $db->insert(tbl_friends, $data);
		return $pid;
	}
	
	function remove($friendid) {
		$db = Database::obtain();
		
		if ($this->checkHaveFriendAlready($friendid) == false) {
			$msg = 'You are not friends with this person already silly';
			return $msg;
		}
		
		if ($this->checkFriendExists($friendid) == false) {
			$msg = 'This user doesn\'t exist in our system';
			return $msg;
		}		
		
		$sql = "DELETE FROM " . tbl_friends . " WHERE user_id = " . (int)$_SESSION['userid'] . " AND friend_id = " . (int)$friendid;
		$q = $db->query($sql);
	}
	
	function checkFriendExists($friendid) {
		$db = Database::obtain();

		$sql = "SELECT user_id
			FROM " . tbl_users . "
			WHERE user_id = " . (int)$friendid;

		$row = $db->query_first($sql);
		
		if ($row > 0) {
			return true;
		}

		return false;		
	}
	
	function checkHaveFriendAlready($friendid) {
		$db = Database::obtain();	
		
		$sql = "SELECT friend_id
			FROM " . tbl_friends . "
			WHERE user_id = " . (int)$_SESSION['userid'] . "
			AND friend_id = " . (int)$friendid;
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
}
?>
