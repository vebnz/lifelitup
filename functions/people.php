<?php
require_once('classes/people.php');

$people = new People;

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


?>
