<?php
require_once('classes/authenticate.php');
require_once('functions/misc.php');
require_once('classes/log.php');
require_once('classes/event.php');

$auth = new Authenticate;

if ($_GET['action'] == 'confirm') {
		$code = $_GET['code']; 
		$userid = intval($_GET['userid']);
	
		if (empty($code)) {
			event::fire('HAX_CONFIRMATION_CODE');
			$msg = 'The confirmation code is empty, did you tamper with the URL?';
			return;
		}

		if (empty($userid)) {
			event::fire('HAX_CONFIRMATION_USERID');
			$msg= 'The User Identifcation code is empty, did you tamper with the URL?';
			return;
		}

		if (!preg_match('/^[a-fA-F0-9]+$/', $code)) {
			event::fire('HAX_CONFIRMATION_CODE');
			$msg = 'The confirmation code is borked, did you tamper with the URL?';
			return;
		}

		if (strlen($code) < 32) {
			event::fire('HAX_CONFIRMATION_CODE');
			$msg = 'The confirmation code is borked, did you tamper with the URL?';
			return;
		}

		if ($auth->checkCode($userid, $code)) {
			$isConfirmed = 1;
			$auth->verifyUser($userid);
		}
		else {
			$msg = 'Confirmation code is wrong. <a href=\"#\">Click here to recieve another one.</a>';
			return;
		}
}

if (isset($_POST['login'])) {

	$op = $_POST['op'];
	$dest = $_POST['dest'];
	if ($op !== 'new' && $op !== 'login') {
		die('Unknown request');
	}

	$email = $_POST['email']; 
	$password = $_POST['password']; 
	
	if (!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i', $email)) {
		$msg = 'Invalid email address';
		return;
	}
	
	if (empty($password)) {
		$msg = 'You need to enter a password';
		return;
	}

	if (strlen($password) > 72) {
		$msg = 'The supplied password is too long';
		return;
	}

	$login = $auth->login($email, $password);
	if ($login > 0) {
		$verified = $auth->isVerified($login['id']);
		if (empty($verified)) {
			$msg = 'You have not confirmed your email address';
			return;
		}

		$auth->validateUser($login);
		event::fire('USER_LOGIN');
		
		if(!empty($dest)) {
			header('Location: ' . $dest);
		}
		else
		{
			header("Location: index.php");
		}
		die;
	}
	
	$msg = $login;
}

if (isset($_POST['register'])) {

    $op = $_POST['op'];
    if ($op !== 'new' && $op !== 'login') {
	    die('Unknown request');
    }   

	$email = $_POST['email'];
	$pass1 = $_POST['pass1']; 
	$pass2 = $_POST['pass2'];
	$remove = $_POST['remove'];

    if (!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i', $email)) {
	    $msg = 'Invalid email address';
        return;
    }

	if (empty($pass1)) {
		$msg = 'You need a password to continue';
		return;
	}

	if (empty($pass2)) {
		$msg = 'You need to confirm your password';
		return;
	}

	if (strlen($remove) != 0) {
		$msg = 'Remove the text to continue';
		return;
	}

	if ($pass1 != $pass2) {
		$msg = 'Both passwords must be the same';
		return;
	}

	if (strlen($email) > 250) {
		$msg = 'Email address must be under 250 characters';
		return;
	}

	event::register('USER_REGISTRATION', function($args = array()){
		if ($_SERVER['HTTP_REFERER'] != 'http://lifelitup.com/register.php') {
			// can't really do much here until the site is live... but it's an example nevertheless.
		}
		// give person a badge for registering etc
	});
	
	$register = $auth->register($email, $pass1);
	
	if ($register == true) {
		$msg = 'You have registered';
		event::fire('USER_REGISTRATION');
		return;
	}
	else {
		$msg = 'Registration has failed';
		return;
	}
}

if (isset($_POST['forgotSubmit'])) {

	$op = $_POST['op'];
    if ($op !== 'forgot') {
	    die('Unknown request');
    } 
	
	$email = $_POST['email'];
	
	if (empty($email)) {
		$msg = 'You need to enter in an email to continue.';
		return;
	}

	if (!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i', $email)) {
	    $msg = 'This is an invalid email address';
        return;
    }	
	
	$forgot = $auth->sendForgotEmail($email);
	
	if (empty($forgot)) {
		event::fire('USER_FORGOT_PASSWORD');
		$msg = "An email has been sent to you. Please read this email and follow the instructions within to reset your password.";
	}
	else {
		$msg = $forgot;
	}
		
	return $msg;
	
}

if (isset($_POST['resetSubmit'])) {
	$code = $_POST['code']; 
	$userid = intval($_POST['userid']);
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	
	if (empty($code)) {
		event::fire('HAX_CONFIRMATION_CODE');
		$msg = 'The confirmation code is empty, did you tamper with the URL?';
		return;
	}

	if (empty($userid)) {
		event::fire('HAX_CONFIRMATION_USERID');
		$msg= 'The User Identifcation code is empty, did you tamper with the URL?';
		return;
	}

	if (!preg_match('/^[a-fA-F0-9]+$/', $code)) {
		event::fire('HAX_CONFIRMATION_CODE');
		$msg = 'The confirmation code is borked, did you tamper with the URL?';
		return;
	}

	if (strlen($code) < 32) {
		event::fire('HAX_CONFIRMATION_CODE');
		$msg = 'The confirmation code is borked, did you tamper with the URL?';
		return;
	}
	
	if ($password != $cpassword) {
		$msg = 'The passwords you entered do not match.';
		return;
	}

	if ($auth->checkCode($userid, $code)) {
		$isConfirmed = 1;
		$auth->resetPassword($userid, $password);
		return;
	}
	else {
		$msg = 'Confirmation code is wrong. <a href=\"#\">Click here to recieve another one.</a>';
		return;
	}
}

?>
