<?php
class Log
{
		private static $logInstance;

		public static function getInstance() {
				if (!self::$logInstance)
				{
						self::$logInstance = new Log();
				}    
				return self::$logInstance;
		}	 

		function NewLog($event) {
				$db = Database::obtain();

				$ip = $this->getIP();
				
				$time = time();
				$host = gethostbyaddr($ip);
				$page = basename($_SERVER['PHP_SELF']); 
				$pageid = isset($_GET['page']) ? $_GET['page'] : '0';
				$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '0';
				$details = $ip . "," . $host . "," . $page . "," . $pageid . "," . $referrer;

				//$db->insert(tbl_logs, $data); -- we need a bit more configurability in our query
				$sql = "INSERT DELAYED INTO " . tbl_logs . " 
						('event_type', 'log_date', 'details') 
						VALUES ('" . $event . "', '" . $time . "', '" . $details . "');";
				$db->query($sql);
		}  

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
}
?>
