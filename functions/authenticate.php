<?php
require_once('/home/life/public_html/classes/authenticate.php');

$auth = new Authenticate;

if (isset($_POST['login'])) {

	$op = $_POST['op'];
	if ($op !== 'new' && $op !== 'login') {
		die('Unknown request');
	}

	$username = $_POST['username']; // secure this from injection
	$password = $_POST['password']; // secure this from injection

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

	$username = $_POST['username']; // secure this from injection
	$pass1 = $_POST['pass1']; // secure this from injection
	$pass2 = $_POST['pass2']; // secure this from injection
	$remove = $_POST['remove']; // secure this from injection

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
