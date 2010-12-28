<?php

class People {

	function exists($ip) {
		$db = Database::obtain();

		$sql = "SELECT 1 FROM " . tbl_people . " WHERE ip = " . ip2long($ip);
		$row = $db->query_first($sql);

		if (!empty($row)) {
			return true;
		}
		else {
			return false;
		}
	}

	function online() {
		$db = Database::obtain();

		$sql = "SELECT COUNT(*) as counted FROM " . tbl_people;
		$row = $db->query_first($sql);

		return $row['counted'];
	}

	function insert($ip) {
		$db = Database::obtain();

		$data['ip'] = ip2long($ip);
		$data['time'] = "NOW()";

		$pid = $db->insert(tbl_people, $data);

		return $pid;
	}

	function update($ip) {
		$db = Database::obtain();
	
		$data['time'] = "NOW()";
		$db->update(tbl_people, $data, "ip=" . ip2long($ip));
	}

	function truncate() {
		$db = Database::obtain();

		$sql = "DELETE FROM " . tbl_people . " WHERE time < SUBTIME(NOW(),'0 0:10:0')";
		$db->query($sql);
	}

}

?>
