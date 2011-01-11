<?php

class Profile {

	function exists($userid) {
		// if profile doesn't exist.. create it
		$db = Database::obtain();

		$sql = "SELECT 1 FROM " . tbl_profile . " WHERE user_id = " . (int)$userid;
		$row = $db->query_first($sql);
        
		if (empty($row)) {
            return $this->create($userid);	
		}
	}
	function create($userid) {
		$db = Database::obtain();

		$data['user_id'] = (int)$userid;
		$pid = $db->insert(tbl_profile, $data);

		return $pid;
	}

	function get($userid) {
		$db = Database::obtain();
		
		$sql = "SELECT user_id, first_name, last_name, twitter, facebook 
				FROM " . tbl_profile . "
				WHERE user_id = " . (int)$userid;
		return $record = $db->fetch($db->query($sql));
	}

	function update($data, $userid) {
			$db = Database::obtain();
			$db->update(tbl_profile, $data, "user_id=" . (int)$userid);
	}
}

?>
