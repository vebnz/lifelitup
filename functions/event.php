<?php	
	require_once('../classes/event.php');
	require_once('../classes/log.php');
	
	// register the new event and do what needs to be done
	event::register('USER_REGISTRATION', function($args = array()){
		// do whatever you want here
	});
	
	// initiate the event
	event::fire('USER_REGISTRATION');
	
?>