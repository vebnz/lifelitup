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

		$data['code'] = bin2hex(shell_exec('head -c 16 < /dev/urandom'));
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

	function checkCode($userid, $code) {
		$db = Database::obtain();

		$sql = "SELECT 1 FROM " . tbl_users . "
				WHERE id = " . intval($userid) . "
				AND code = '" . $code . "'";
		return $db->query_first($sql);
	}

	function verifyUser($userid) {
		$db = Database::obtain();

		$data['verified'] = 1;
		$data['last_update'] = time();

		$db->update(tbl_users, $data, "id='" . intval($userid) . "'");
	}

	function isVerified($userid) {
		$db = Database::obtain();

		$sql = "SELECT 1 FROM " . tbl_users . "
				WHERE verified = 1
				AND id = " . intval($userid);
		return $db->query_first($sql);
	}
	
	function sendForgotEmail($email) {
		$db = Database::obtain();
		
		$sql = "SELECT id FROM ". tbl_users . "
				WHERE email = '" . $email . "'";
		
		$row = $db->query_first($sql);

		if (empty($row))
		{
			$msg = "This email does not exist in our system";
			return $msg;
		}	
		
		$data['code'] = bin2hex(shell_exec('head -c 16 < /dev/urandom'));
		$db->update(tbl_users, $data, "id=" . $row['id'] . "");
		
		$subject = "Reset your password at LifeLitUp.com";
        $emailMsg = "As requested, you can now reset your password on LifeLitUp.\n"
                        ."Click below to verify your account and reset your password: \n\n"
                        ." http://www.lifelitup.com/alpha/forgot_password.php?action=reset&code=" . $data['code'] . "&userid=" . intval($row['id']) . "\n\n"
                        ."Once your account is verified, you'll be able to insert a new password for your account.\n\n"
                        ."Regards,\n"
                        ."The LLU Team!\n\n"
                        ."-----------------------------\n\n"
                        ."If you didn't request this password reset, please contact us as help@lifelitup.com.";
                
        $headers = 'From: no-reply@lifelitup.com' . "\r\n" .
                       'Reply-To: no-reply@lifelitup.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
                
        mail($email, $subject, $emailMsg, $headers);		

		return;		
		
	}
	
	function resetPassword($userid, $password) {
		$db = Database::obtain();

		$data['password'] = $hasher->HashPassword($password);
		$data['last_update'] = time();

		$db->update(tbl_users, $data, "id='" . intval($userid) . "'");
	}

}

?>
