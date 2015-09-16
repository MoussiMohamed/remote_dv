<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
	
//Connect to database
$query = "select * from produit";
$reqExec = mysql_query($query);

$produit;

while ($produit[] = mysql_fetch_assoc($reqExec)) {

}

$jsonEncode = json_encode($produit);

echo "{" . "\"d\"" . ":" . $jsonEncode . "}";
?>