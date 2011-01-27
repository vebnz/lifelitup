<?php

class Profile {

	function exists($userid) {
		// if profile doesn't exist.. create it
		$db = Database::obtain();

		$sql = "SELECT 1 FROM " . tbl_profile . " WHERE user_id = " . (int)$userid;
		$row = $db->query_first($sql);
        
		if (empty($row)) {
            return $this->create($userid);	
		}
	}
	function create($userid) {
		$db = Database::obtain();

		$data['user_id'] = (int)$userid;
		$pid = $db->insert(tbl_profile, $data);

		return $pid;
	}

	function get($userid) {
		$db = Database::obtain();
		
		$sql = "SELECT user_id, first_name, last_name, twitter, facebook, email 
				FROM " . tbl_profile . "
				JOIN " . tbl_users . " ON " . tbl_profile . ".user_id = " . tbl_users . ".id				
				WHERE " . tbl_users . ".id = " . (int)$userid;
		return $db->query_first($sql);
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
	
	function getActivities($userid) {
		$db = Database::obtain();
		
		$sql = "(SELECT " . tbl_achievements . ".user_id, " . tbl_achievements . ".date, " . tbl_goals . ".id, " . tbl_goals . ".name, 'achievement' AS act_type
			FROM " . tbl_achievements . "
			JOIN " . tbl_goals . " ON " . tbl_achievements . ".goal_id = " . tbl_goals . ".id
			WHERE " . tbl_achievements . ".user_id = " . $userid . ")
			UNION (SELECT " . tbl_todo . ".user_id, " . tbl_todo . ".date, " . tbl_goals . ".id, " . tbl_goals . ".name, 'todo' AS act_type 
			FROM " . tbl_todo . " 
			JOIN " . tbl_goals . " ON " . tbl_todo . ".goal_id = " . tbl_goals . ".id
			WHERE " . tbl_todo . ".user_id = " . $userid . ")
			UNION (SELECT " . tbl_comments . ".user_id, " . tbl_comments . ".date, " . tbl_goals . ".id, " . tbl_goals . ".name, 'comment' AS act_type 
			FROM " . tbl_comments . " 
			JOIN " . tbl_goals . " ON " . tbl_comments . ".page_id = " . tbl_goals . ".id
			WHERE " . tbl_comments . ".user_id = " . $userid . ")
			UNION (SELECT " . tbl_friends . ".user_id, " . tbl_friends . ".date, " . tbl_profile . ".user_id, CONCAT_WS(' ', " . tbl_profile . ".first_name,  " . tbl_profile . ".last_name), 'friend' AS act_type 
			FROM " . tbl_friends . " 
			JOIN " . tbl_profile . " ON " . tbl_friends . ".friend_id = " . tbl_profile . ".user_id
			WHERE " . tbl_friends . ".user_id = " . $userid . ")
			ORDER BY date DESC";
			
		return $db->fetch_array($sql);
	}
	
	function update($data, $userid) {
			$db = Database::obtain();
			$db->update(tbl_profile, $data, "user_id=" . (int)$userid);
	}
		
}

?>
