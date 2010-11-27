<?php

class Pages {

	function createNavbar($logged_in) {
		$db = Database::obtain();

		$sql = "SELECT id, name, url
			FROM " . tbl_pages . "
			WHERE logged_in = " . (int)$logged_in;
		$row = $db->fetch_array($sql);
	
		return $row;
	}

}

?>
