<?php	
	require_once('event.class.php');
	
	// dummy user data entered on registration
	$userInfo = array(
		'id' => '1', 
		'username' => 'kingy', 
		'password' => '12345'
	); 
		
	// register the new event and do what needs to be done
	event::register('USER_REGISTRATION', function($args = array()){
		/* do whatever you want here
		 * insert new registration log for $userInfo[id] etc
		 */
		 
	});
	
	// initiate the event
	event::fire('USER_REGISTRATION', $userInfo);
	
?>