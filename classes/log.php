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

	function NewLog($event)
	{

		$db = Database::obtain();

		$data['event_type'] = $event;

		$date = date("d/m/y") ." ". date("H:i:s");
		$data['log_date'] = $date;


		$ip = $this->getRealIpAddr();
		$host = gethostbyaddr($ip);
		$page = basename($_SERVER['PHP_SELF']); 
		$pageid = isset($_GET['page']) ? $_GET['page'] : '0';
		$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '0';
		$details = $ip . "," . $host . "," . $page . "," . $pageid . "," . $referrer;

		$data['details'] = $details;

		$db->insert(tbl_logs, $data);

	}  

<<<<<<< HEAD
        function getIP() {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) { // localhost
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
                else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { // proxy IP check
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                }
                return $ip;
        }
=======
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
>>>>>>> d919e4cf24346f580794c12163ae2b514dcc1d81
}
?> 
