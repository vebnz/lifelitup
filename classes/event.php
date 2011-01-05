<?php
<<<<<<< HEAD:classes/event.php

	class event
=======
require_once('log.class.php');

class event
{
	public static $events = array();
	public static function fire($event, $args = array())
>>>>>>> a01f7f2a61f8e232be3acec11e574eff1370f4c4:includes/event/event.class.php
	{
		if(isset(self::$events[$event]))
		{
<<<<<<< HEAD:classes/event.php
			if (isset(self::$events[$event]))
			{
				foreach (self::$events[$event] as $func)
				{
					call_user_func($func, $args);		
				}
			}

			$Log = Log::getInstance();
			$Log->NewLog($event);

		}
		public static function register($event, Closure $func)
		{
			self::$events[$event][] = $func;			
=======
			foreach(self::$events[$event] as $func)
			{
				call_user_func($func, $args);
				$Log = Log::getInstance();
				$Log->NewLog($event, $args);					
			}
>>>>>>> a01f7f2a61f8e232be3acec11e574eff1370f4c4:includes/event/event.class.php
		}

	}
	public static function register($event, Closure $func)
	{
		self::$events[$event][] = $func;			
	}
}
?>
