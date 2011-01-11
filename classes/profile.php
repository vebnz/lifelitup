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

	// untested
	function update($arr, $userid) {
		if (count($arr) > 0) {
			$db = Database::obtain();
			foreach ($arr as $k => $v) {
				$data[$k] = $v;
			}
			$db->update(tbl_profile, $data, "id=" . (int)$userid);
		}
	}
}

?>
