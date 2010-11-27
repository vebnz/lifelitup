<?php

class Todo {

	function show($userid) {
		$db = Database::obtain();

		$sql = "SELECT " . tbl_goals . ".id, name, icon, username, email
		        FROM " . tbl_todo . "
        		JOIN " . tbl_goals ." ON " . tbl_todo . ".goal_id = " . tbl_goals . ".id
       			JOIN " . tbl_users . " ON " . tbl_todo . ".user_id = " . tbl_users . ".id
        		WHERE " . tbl_users . ".id =  " . $userid;
		$goals = $db->fetch_array($sql);

		return $goals;
	}

	function checkGoalExists($goalid) {
		$db = Database::obtain();

		$sql = "SELECT name
			FROM " . tbl_goals . "
			WHERE id = " . (int)$goalid;
		$row = $db->query_first($sql);

		if (!empty($row)) {
			return true;
		}
	
		return false;
	}

	function checkHaveAlready($goalid, $userid) {
		$db = Database::obtain();

		$sql = "SELECT id
			FROM " . tbl_todo . "
			WHERE user_id = " . (int)$userid . "
			AND goal_id = " . (int)$goalid;
		$row = $db->query_first($sql);
		
		if ($row > 0) {
			return true;
		}

		return false;
	}

	function add($goalid, $userid) {
		$db = Database::obtain();

		if ($this->checkHaveAlready($goalid, $userid) == true) {
			$msg = 'You already have this goal';
			return $msg;
		}

		if ($this->checkGoalExists($goalid) == false) {
			$msg = 'This goal does not exist';
			return $msg;
		}

		$data['goal_id'] = $goalid;
		$data['user_id'] = $userid;

		$pid = $db->insert(tbl_todo, $data);
	}

}

?>