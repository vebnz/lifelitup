<?php
//database server
define('DB_SERVER', "localhost");

//database login name
define('DB_USER', "root");
//database login password
define('DB_PASS', "root");

//database name
define('DB_DATABASE', "life_app");

//smart to define your table names also
define('tbl_users', "tbl_users");
define('tbl_goals', "tbl_goals");
define('tbl_todo', "tbl_todo");
define('tbl_blog', "tbl_blog");
define('tbl_people', "tbl_people");
define('tbl_logs', "tbl_logs");
define('tbl_profile', "tbl_profile");
define('tbl_achievements', "tbl_achievements");
define('tbl_friends', "tbl_friends");
define('tbl_status', "tbl_status");

// twig
define('current_theme', "themes/dotdotgo");

// start the session
session_start();
?>
