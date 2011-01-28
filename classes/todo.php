<?php

class Todo {

	function show($userid, $categoryid) {
		$db = Database::obtain();

		$sql = "SELECT " . tbl_goals . ".id, " . tbl_goals . ".name AS name, icon, " . tbl_category . ".name as category_name, " . tbl_category . ".id as category_id
		        FROM " . tbl_todo . "
        		JOIN " . tbl_goals ." ON " . tbl_todo . ".goal_id = " . tbl_goals . ".id
       			JOIN " . tbl_users . " ON " . tbl_todo . ".user_id = " . tbl_users . ".id
				JOIN " . tbl_category . " on " . tbl_goals . " . category_id = " . tbl_category . ".id
        		WHERE " . tbl_users . ".id =  " . intval($userid) ."
				AND " . tbl_category . ".id = " . intval($categoryid);
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
	
	function checkAlreadyCompleted($goalid, $userid) {
		$db = Database::obtain();
		
		$sql = "SELECT id
			FROM " . tbl_achievements . "
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
		
		if ($this->checkAlreadyCompleted($goalid, $userid) == true) {
			$msg = 'You have already completed this goal silly.';
			return $msg;
		}

		$data['goal_id'] = $goalid;
		$data['user_id'] = $userid;
		$data['date'] = time();

		$pid = $db->insert(tbl_todo, $data);
	}

	function remove($goalid, $userid) {
		$db = Database::obtain();
		
		if ($this->checkHaveAlready($goalid, $userid) == false) {
			$msg = 'This goal does not exist on your TODO list';
			return $msg;
		}
		
		if ($this->checkGoalExists($goalid) <= 0) {
			$msg = 'This goal does not exist';
			return $msg;
		}
		
		$sql = "DELETE FROM " . tbl_todo . " WHERE user_id = " . $userid . " AND goal_id = " . $goalid;
		$db->query($sql);
	}

    function showTodoCategories($userid) {
        $db = Database::obtain();

        $sql = "SELECT " . tbl_category . ".id AS id, " . tbl_category . ".name AS name, COUNT(*) AS count
                FROM " . tbl_category . "
				JOIN " . tbl_goals . " ON " . tbl_category . ".id = " . tbl_goals . ".category_id
				JOIN " . tbl_todo . " ON " . tbl_goals . " .id = " . tbl_todo . ".goal_id
				WHERE " . tbl_todo . ".user_id = " . intval($userid) . "
				GROUP BY " . tbl_category . ".name";
        return $db->fetch_array($sql);
    }

	
}

?>
