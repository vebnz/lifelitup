<?php

// meh doesn't work, I fail
function get_post_var($var) {
	$val = $_POST[$var];
	if (get_magic_quotes_gpc())
		$val = stripslashes($val);
	return $val;
}

?>
