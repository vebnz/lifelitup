<?php

class Goals {

	function showAll() {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon
				FROM " . tbl_goals;
		return $db->fetch_array($sql);

	}

	function showByCategory($category = 1) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon 
			FROM " . tbl_goals . "
			WHERE categoryid = " . (int)$category;
		return $db->fetch_array($sql);
	}

	function show($id) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon, info
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
