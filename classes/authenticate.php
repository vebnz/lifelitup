<?php
require_once('includes/PasswordHash.php');
$hasher = new PasswordHash(8, TRUE);

class Authenticate {

	function getUsername($userid) {
		$db = Database::obtain();

		$sql = "SELECT username
			FROM " . tbl_users . "
			WHERE id = " . (int)$userid;
		$row = $db->query_first($sql);

		return $row['username'];
	}

	function validateUser($row) {
		session_regenerate_id();

		$_SESSION['valid'] = 1;
		$_SESSION['userid'] = $row['id'];
		$_SESSION['username'] = $row['username'];
	}

	function isLoggedIn() {
		if ($_SESSION['valid']) {
			return true;
		}

		return false;
	}

	function logout() {
		$_SESSION = array();
		session_destroy();
	}

	function login($username, $password) {
		global $hasher;
	        $db = Database::obtain();

		$sql = "SELECT id, password
			FROM " . tbl_users . "
			WHERE username = '" . $username . "'
			";
		$row = $db->query_first($sql);
		
		if (empty($row)) {
			$msg = 'No such user exists';
			return $msg;
		}
		
		if (!$hasher->CheckPassword($password, $row['password'])) {
			$msg = 'Password incorrect';
			return $msg;
		}
		
		unset($hasher);
		return $row;
	}	

	function register($username, $password) {
		global $hasher;
		$db = Database::obtain();

		$data['username'] = $username;
		$data['password'] = $hasher->HashPassword($password);

		if (strlen($data['password']) < 20) {
			die('Failed to hash new password');
		}
		unset($hasher);
		
		$pid = $db->insert(tbl_users, $data);
	
		if ($pid > 0) {
			return true;
		}
		else {
			return false;
		}
	}
}

?>
