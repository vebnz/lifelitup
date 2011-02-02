<?php

class Goals {

	function showAll() {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon, category_id, descriptive_image
				FROM " . tbl_goals;
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

		$sql = "SELECT id, name, icon, info, descriptive_image
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
