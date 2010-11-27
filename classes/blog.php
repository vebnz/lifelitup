<?php

class Blog {

	function showAll() {
		$db = Database::obtain();

		$sql = "SELECT " . tbl_blog . ".id, title, content, date_posted, username 
			FROM " . tbl_blog . "
			JOIN ". tbl_users . " 
			ON " . tbl_blog . ".user_id = " . tbl_users . ".id
			ORDER BY " . tbl_blog . ".id DESC";
		$rows = $db->fetch_array($sql);
		
		return $rows;
	}

	function showPost($id) {
		$db = Database::obtain();

                $sql = "SELECT " . tbl_blog . ".id, title, content, date_posted, username 
                        FROM " . tbl_blog . "
                        JOIN ". tbl_users . " 
                        ON " . tbl_blog . ".user_id = " . tbl_users . ".id
                	WHERE " . tbl_blog . ".id = " . (int)$id;
		$rows = $db->fetch_array($sql);
                
                return $rows;
	}

}

?>
