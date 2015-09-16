<?php
    header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
$id_region=($_POST['idRegion']);

mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
		
$query="delete from region where id_region='$id_region'";
	$reqExec=mysql_query($query);
 echo "row deleted";

mysql_close();
?>