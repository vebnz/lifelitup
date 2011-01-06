<?php
require_once('includes/config.php');
require_once('database/db.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

require_once('functions/admin/user.php');
require_once('includes/TableGear/include/TableGear1.6.1.php');

$options["database"]["table"] = "tbl_users";
$table = new TableGear($options);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="includes/TableGear/javascripts/TableGear1.6.1-jQuery.js"></script>
<link type="text/css" rel="stylesheet" href="includes/TableGear/stylesheets/tablegear.css" />
<?
echo $table->getTable();
echo $table->getJavascript("jquery");

$db->close();
?>
