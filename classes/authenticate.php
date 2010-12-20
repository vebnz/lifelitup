<?php

class Authenticate {

	// Authentication system should use bcrypt for storing passwords

	function getUsername($userid) {
		$db = Database::obtain();

		$sql = "SELECT username
			FROM " . tbl_users . "
			WHERE id = " . (int)$userid;
		$row = $db->query_first($sql);

		return $row['username'];
	}

	function generateSalt() {
		$string = md5(uniqid(rand(), true));
		return substr($string, 0, 3);
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
	        $db = Database::obtain();

		$sql = "SELECT id, password, salt, username
			FROM " . tbl_users . "
			WHERE username = '" . $username . "'
			";
		$row = $db->query_first($sql);
		
		if (empty($row)) {
			$msg = 'No such user exists';
			return $msg;
		}

		$hash = sha1($row['salt'] . sha1($password));
		
		if ($hash != $row['password']) {
			$msg = 'Password incorrect';
			return $msg;
		}

		return $row;
	}	

	function register($username, $password) {
		$db = Database::obtain();

		$salt = $this->generateSalt();	
	
		$data['username'] = $username;
		$data['password'] = sha1($salt . sha1($password));
		$data['salt'] = $salt;

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
