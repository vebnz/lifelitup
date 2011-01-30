<?php
require_once('includes/PasswordHash.php');
require_once('classes/profile.php');
$hasher = new PasswordHash(8, TRUE);

$prof = new Profile;

class Authenticate {

	function getEmail($userid) {
		$db = Database::obtain();

		$sql = "SELECT email
			FROM " . tbl_users . "
			WHERE id = " . (int)$userid;
		$row = $db->query_first($sql);

		return $row['email'];
	}

	function validateUser($row) {
		session_regenerate_id();

		if(key_exists('valid', $_SESSION)) {
			$_SESSION['valid'] = 1;
			$_SESSION['userid'] = $row['id'];
		} else {
			$_SESSION = array(
				'valid' => 1,
				'userid' => $row['id']
			);
		}
	}

	function isLoggedIn() {
		if(key_exists('valid', $_SESSION))
			if ($_SESSION['valid'])
				return true;

		return false;
	}

	function logout() {
		$_SESSION = array();
		session_destroy();
	}

	function login($email, $password) {
		global $hasher;
	    	$db = Database::obtain();

		$sql = "SELECT id, password
				FROM " . tbl_users . "
				WHERE email = '" . $email . "'
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

	function register($email, $password) {
		global $hasher;
		global $prof;

		$db = Database::obtain();
		
		$sql = "SELECT 1
			FROM " . tbl_users . "
			WHERE email = '" . $email . "'";
		$row = $db->query_first($sql);
		
		if (!empty($row)) {
			$msg = 'Email address already exists.';
			return $msg;
		}

		$data['code'] = shell_exec('head -c 16 < /dev/urandom');
		$data['email'] = $email;
		$data['password'] = $hasher->HashPassword($password);

		if (strlen($data['password']) < 20) {
			die('Failed to hash new password');
		}
		unset($hasher);
		
		$pid = $db->insert(tbl_users, $data);
	
		if ($pid > 0) {
			$prof->create($pid);
			$prof->sendVerificationEmail($pid);
			return true;
		}
		else {
			return false;
		}
	}
}

?>
