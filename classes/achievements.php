<?php

class Achievements {

	function add($data) {
		$db = Database::obtain();
					
		$pid = $db->insert('tbl_achievements', $data);
		
		return $pid;

	}
	
	function getAchievements($userid) {
		$db = Database::obtain();
		
		$sql = "SELECT " . tbl_goals . ".id, " . tbl_goals . ".name as name, " . tbl_goals . ".icon as icon
			FROM " . tbl_achievements . "
			JOIN " . tbl_goals . " ON " . tbl_achievements . ".goal_id = " . tbl_goals . ".id
			JOIN " . tbl_users . " ON " . tbl_achievements . ".user_id = " . tbl_users . ".id
			WHERE " . tbl_users . ".id = " . (int)$userid . "
			ORDER BY " . tbl_achievements . ".date DESC";
			
		$achievements = $db->fetch_array($sql);
		
		return $achievements;
	}
	
	function image_file_extension($filename)
	{
		return end(explode(".", $filename));
	}
	
	function show($id, $userid) {
		$db = Database::obtain();

		$sql = "SELECT " . tbl_achievements . ".user_id, " . tbl_achievements . ".goal_id, " . tbl_achievements . ".comments, " . tbl_achievements . ".image, " . tbl_achievements . ".location, " . tbl_achievements . ".date, " . tbl_profile . ".first_name, " . tbl_profile . ".last_name
			FROM " . tbl_achievements . "
			JOIN " . tbl_profile . " ON " . tbl_achievements . ".user_id = " . tbl_profile . ".user_id
			WHERE " . tbl_achievements . ".user_id = " . (int)$userid . " AND " . tbl_achievements . ".goal_id = " . (int)$id;
		return $db->query_first($sql);
	}
	
}

?>
