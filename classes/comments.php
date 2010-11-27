<?php

class Comments {

	function show($page_id) {
		$db = Database::obtain();

		$sql = "SELECT user_id, content, date_posted, username
			FROM " . tbl_comments . "
			JOIN " . tbl_users . " ON " . tbl_comments . ".user_id = " . tbl_users . ".id
			WHERE page_id = " . (int)$page_id;
		$rows = $db->fetch_array($sql);

		return $rows;	
	}

}

?>
