<?php
require_once('classes/authenticate.php');
require_once('functions/misc.php');
require_once('classes/log.php');
require_once('classes/event.php');

$auth = new Authenticate;

if (isset($_POST['login'])) {

	$op = $_POST['op'];
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
		$auth->validateUser($login);
		event::fire('USER_LOGIN');
		$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
		if(isset($_SESSION['destination'])) {
			header('Location: ' . $_SESSION['destination']);
		}
		else
		{
			header("Location: profile.php");
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
?>
