<?php

class Comments {

	function show($table, $page_id) {
		$db = Database::obtain();

		$sql = "SELECT " . tbl_comments .".user_id, content, date_posted, first_name, last_name, email
			FROM " . tbl_comments . "
			JOIN " . tbl_profile . " ON " . tbl_comments . ".user_id = " . tbl_profile . ".user_id
			JOIN " . tbl_users . " ON " . tbl_profile .".user_id = " . tbl_users . ".id
			WHERE page_id = " . (int)$page_id . "
			AND tbl = '" . $table. "'
			ORDER BY date_posted DESC";
		$rows = $db->fetch_array($sql);

		return $rows;	
	}

	function add($userid, $pageid, $table, $content) {
		$db = Database::obtain();
		
		$data['user_id'] = (int)$userid;
		$data['page_id'] = (int)$pageid;
		$data['tbl'] = $table; // secure
		$data['content'] = $content; // secure

		$primary_id = $db->insert(tbl_comments, $data);
		return $primary_id;
	}
}

?>
