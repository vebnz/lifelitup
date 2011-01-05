<?php
require_once('classes/todo.php');

$todo = new Todo;

if ($_GET['action'] == 'addGoal') {
    $id = (int)$_GET['id'];
    $userid = $_SESSION['userid'];

	$add = $todo->add($id, $userid);        
	if ($add < 0) {
		$msg = 'Failed to add goal to your TODO list';
		return;
	}

	if (empty($add)) {
		$msg = 'Added successfully';
	}
	else {
		$msg = $add;
	}
	return $msg;
}

?>
