<?php

class event
{
	public static $events = array();
	public static function fire($event, $args = array())
	{
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
	}
}
?>
