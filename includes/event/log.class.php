<?php
	class Log
	{
		private static $logInstance;

		public static function getInstance()
		{
			if (!self::$logInstance)
			{
				self::$logInstance = new Log();
			}    
		    return self::$logInstance;
		}	 
  
		function NewLog($event, $log = array())
		{
			// connect to database
			// insert log info
			// ID, TYPE, DATE
			// close db
			
			$date = date("d/m/y") ." ". date("H:i:s");
			echo $date . "<br />";
			echo $event . "<br />";
			echo "<pre>";
			print_r($log);
			echo "</pre>";
		}  
	}
?> 