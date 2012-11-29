<?php


//ccc connection
$host = "vhostdb.ucr.edu";
$user = "private";
$pwd = "private_pwd";
$db = "private_db";


// MYSQL CONNECTION CODES
$mysql = mysql_connect($host, $user, $pwd) or die(mysql_error()); ;
mysql_select_db($db) or die(mysql_error());
?>