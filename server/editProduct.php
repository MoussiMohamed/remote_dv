<?php
    header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
$id_Product=($_POST['id_Product']);
$nameProduct=($_POST['nameProduct']);
$timestamp = date('Y-m-d G:i:s');

mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
		
$query="update produit 
	set nom_Produit='$nameProduct', date_Modification='$timestamp' where id_Produit='$id_Product'";
	$reqExec=mysql_query($query);
 echo "row edited";

mysql_close();
?>