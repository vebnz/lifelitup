<?php

class Comments {

	function show($page_id) {
		$db = Database::obtain();

		$sql = "SELECT id, user_id, content, date_posted
			FROM " . tbl_comments . "
			WHERE page_id = " . (int)$page_id;
		$rows = $db->fetch_array($sql);

		return $rows;	
	}

}

?>
