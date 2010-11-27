<?php

class Comments {

	function show($table, $page_id) {
		$db = Database::obtain();

		$sql = "SELECT user_id, content, date_posted, username
			FROM " . tbl_comments . "
			JOIN " . tbl_users . " ON " . tbl_comments . ".user_id = " . tbl_users . ".id
			WHERE page_id = " . (int)$page_id . "
			AND table = " . $table;
		$rows = $db->fetch_array($sql);

		return $rows;	
	}

	function add($userid, $pageid, $content) {
		$db = Database::obtain();
		
		$data['user_id'] = (int)$userid;
		$data['page_id'] = (int)$pageid;
		$data['content'] = $content; // secure

		$primary_id = $db->insert(tbl_comments, $data);
		return $primary_id;
	}
}

?>
