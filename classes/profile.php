<?php

class Profile {

	function exists($userid) {
		// if profile doesn't exist.. create it
		$db = Database::obtain();

		$sql = "SELECT 1 FROM " . tbl_profile . " WHERE userid = " . (int)$userid;
		$row = $db->query_first($sql);

        if (!empty($row)) {
            return $this->create($userid);
        }  		
	}

	function create($userid) {
		$db = Database::obtain();

		$data['userid'] = (int)$userid;
		$pid = $db->insert(tbl_profile, $data);

		return $pid;
	}

}

?>
