<?php

require_once('classes/achievements.php');

$achievement = new Achievements;

if (isset($_POST['submit']))
{
	$data["goal_id"] = $_POST['goalID'];
	$data["user_id"] = $_SESSION['userid'];
	$data["image"] = $_POST['imageName'];
	$data["location"] = $_POST['location'];
	$data["comments"] = $_POST['comments'];	
	$data["date"] = time();
	
	$achievement->add($data);
	
	$msg = "Achievement Successfully Verified!";
}

?>