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
			WHERE " . tbl_users . ".id = " . (int)$userid;
			
		$achievements = $db->fetch_array($sql);
		
		return $achievements;
	}
	
	function image_file_extension($filename)
	{
		return end(explode(".", $filename));
	}
	
}

?>
