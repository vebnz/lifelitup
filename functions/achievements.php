<?php

require_once('classes/achievements.php');
require_once('classes/todo.php');


$achievement = new Achievements;
$todo = new Todo;

if (isset($_GET['action']))
{	
	$data["goal_id"] = $_POST['goal_id'];
	$data["user_id"] = (int)$_SESSION['userid'];
	$data["comments"] = $_POST['comments'];	
	$data["location"] = $_POST['location'];	
	$data["date"] = time();
	
	$id = $achievement->add($data);
	$todo->remove($data["goal_id"], $_SESSION["userid"]);
	
	$msg = "Achievement Successfully Achieved!";
	echo "Achievement Successfully Achieved!";
	event::fire('USER_GOAL_COMPLETION');
}

?>