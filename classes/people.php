<?php

class People {

	function exists($ip) {
		$db = Database::obtain();

		$sql = "SELECT 1 FROM " . tbl_online . " WHERE ip = " . ip2long($ip);
		$row = $db->query_first($sql);

		if (!$empty($row)) {
			return true;
		}
		else {
			return false;
		}
	}

	function insert($ip) {
		$db = Database::obtain();

		$data['ip'] = ip2long($ip);
		$data['time'] = "NOW()";

		$pid = $db->insert(tbl_online, $data);

		return $pid;
	}

	function update($ip) {
		$db = Database::obtain();
	
		$data['time'] = "NOW()";
		$db->update(tbl_online, "ip=" . ip2long($ip));
	}

	function truncate() {
		$db = Database::obtain();

		$sql = "DELETE FROM " . tbl_online . " WHERE time < SUBTIME(NOW(),'0 0:10:0')");
		$db->query($sql);
	}

}

?>
