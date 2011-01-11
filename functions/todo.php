<?php
require_once('classes/todo.php');
require_once('classes/log.php');
require_once('classes/event.php');

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
		event::fire('USER_NEW_GOAL');
		$msg = 'Added successfully. <a href="todo.php">View your list</a>';
	}
	else {
		$msg = $add;
	}
	return $msg;
}

?>
