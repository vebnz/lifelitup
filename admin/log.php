<?php
die('Admin stuff disabled.. let\'s get basic functionality added before moving on to \'behind the scenes\' stuff');
chdir('../');
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('functions/authenticate.php');
require_once('includes/TableGear1.6.1.php');

if (!$auth->isLoggedIn()) {
	echo '<meta http-equiv="refresh" content="0;url=../login.php" />';
	die;
}

$options["database"]["table"] = "tbl_logs";
$options["formatting"]["log_date"] = "eDate";

$table = new TableGear($options);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="../includes/TableGear1.6.1-jQuery.js"></script>
<link type="text/css" rel="stylesheet" href="../includes/tablegear.css" />
<?
echo $table->getTable();
echo $table->getJavascript("jquery");

$db->close();
?>
