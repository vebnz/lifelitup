<?php
$message = array(
	"<div class='user'>Heinrich Ballstein</div><div class='avatar'></div>
		<div class='statup'>added <span class='user'>Martin Scrotebrite</span> as a friend
		</div>",
	"<div class='user'>Scotty McScotsman</div><div class='avatar'></div>
		<div class='statup'>added a todo
		</div>",
	"<div class='user'>Ponch Longstockings</div><div class='avatar'></div>
		<div class='statup'>completed an achievement: <span class='achievement'>Incontinental Breakfast</span>
		</div>"
	);
$rand_keys = array_rand($message);
echo $message[$rand_keys];
?>