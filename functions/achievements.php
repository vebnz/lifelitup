<?php

require_once('classes/achievements.php');
require_once('classes/todo.php');


$achievement = new Achievements;
$todo = new Todo;

if (isset($_POST['submit']))
{
	$fileExt = $achievement->image_file_extension($_POST["imageName"]);
	$newFile = $_SESSION['userid'] . "_" . time() . "." . $fileExt;
		
	rename("uploads/" . $_POST["imageName"], "uploads/" . $newFile);

	$data["goal_id"] = $_POST['goalID'];
	$data["user_id"] = (int)$_SESSION['userid'];
	$data["image"] = $newFile;
	$data["location"] = $_POST['location'];
	$data["comments"] = $_POST['comments'];	
	$data["date"] = time();
	
	$achievement->add($data);
	$todo->remove($data["goal_id"], $_SESSION["userid"]);
	
	$msg = "Achievement Successfully Achieved!";
	header("Location: todo.php");
}

?>