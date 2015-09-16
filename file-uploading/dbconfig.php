<?php
$dbhost = "10.0.210.173";
$dbuser = "moha";
$dbpass = "moha";
$dbname = "db_e_adv";
mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');
?>