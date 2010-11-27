<?php

class Goals {

	function showAll() {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon 
			FROM " . tbl_goals;
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
}

?>
