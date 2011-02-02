<?php

class Goals {

	function showAll($userid) {
		$db = Database::obtain();

		if (empty($userid)) {
			return;
		}

		$sql = "SELECT " . tbl_goals . ".id, name, icon, category_id, descriptive_image
			FROM " . tbl_goals . "
			LEFT OUTER JOIN " . tbl_todo . " ON " . tbl_goals .".id = " . tbl_todo . ".goal_id
			AND " . tbl_todo . ".user_id = " . intval($userid) ."
			LEFT OUTER JOIN " . tbl_achievements . " ON " . tbl_goals . ".id = " . tbl_achievements . ".goal_id
			AND " . tbl_achievements . ".user_id =  " . intval($userid) ."
			WHERE " . tbl_todo . ".goal_id IS NULL
			AND " . tbl_achievements . ".goal_id IS NULL";
		
		return $db->fetch_array($sql);

	}

	function showByCategory($category = 1) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon, descriptive_image 
			FROM " . tbl_goals . "
			WHERE category_id = " . (int)$category;
		return $db->fetch_array($sql);
	}

	function show($id) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon, info, descriptive_image, location
			FROM " . tbl_goals . "
			WHERE id = " . (int)$id;
		return $db->query_first($sql);
	}

	function showCategories() {
		$db = Database::obtain();

		$sql = "SELECT id, name
				FROM " . tbl_category;
		return $db->fetch_array($sql);
	}
}

?>
