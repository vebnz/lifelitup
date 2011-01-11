<?php

class Goals {

	function showAll($category = 1) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon 
			FROM " . tbl_goals . "
			WHERE categoryid = " . (int)$category;
		$rows = $db->fetch_array($sql);
		
		return $rows;
	}

	function show($id) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon, info
			FROM " . tbl_goals . "
			WHERE id = " . (int)$id;
		$rows = $db->query_first($sql);

		return $rows;
	}

	function showCategories() {
		$db = Database::obtain();

		$sql = "SELECT id, name
				FROM " . tbl_category;
		return $db->fetch($db->query($sql));
	}
}

?>
