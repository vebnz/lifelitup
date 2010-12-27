<?php
include 'includes/PasswordHash.php';
$pass = 'fuck';
$hasher = new PasswordHash(8, FALSE);
$hash = $hasher->HashPassword($pass);
if (strlen($hash) < 20)
	die('Failed to hash new password');
unset($hasher);

$hasher = new PasswordHash(8, FALSE);
	if ($hasher->CheckPassword($pass, $hash)) {
		$what = 'Authentication succeeded';
	} else {
		$what = 'Authentication failed';
	}
	unset($hasher);
echo $what;
?>
