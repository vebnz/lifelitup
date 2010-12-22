<?php
require_once('classes/authenticate.php');
require_once('misc.php');

$auth = new Authenticate;

if (isset($_POST['login'])) {

	$op = $_POST['op'];
	if ($op !== 'new' && $op !== 'login') {
		die('Unknown request');
	}

	$username = $_POST['username']; 
	$password = $_POST['password']; 
	
	if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $username)) {
		$msg = 'Invalid username';
		return;
	}

	if (strlen($password) > 72) {
		$msg = 'The supplied password is too long';
		return;
	}

	$login = $auth->login($username, $password);
	
	if ($login > 0) {
		$auth->validateUser($login);
		header("Location: profile.php");
		die;
	}
	
	$msg = $login;
}

if (isset($_POST['register'])) {

        $op = $_POST['op'];
        if ($op !== 'new' && $op !== 'login') {
                die('Unknown request');
        }   

	$username = $_POST['username'];
	$pass1 = $_POST['pass1']; 
	$pass2 = $_POST['pass2'];
	$remove = $_POST['remove'];

        if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $username)) {
                $msg = 'Invalid username';
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

	if (strlen($username) > 30) {
		$msg = 'Username must be under 30 characters';
		return;
	}

	$register = $auth->register($username, $pass1);
	
	if ($register == true) {
		$msg = 'You have registered';
		return;
	}
	else {
		$msg = 'Registration has failed';
		return;
	}
}
?>
