<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
	
//Connect to database
$query = "select u.id_user, u.name, tblup.file,p.nom_Produit,ts.nbr_visite,ts.date_visite,ts.temps_passe,
tl.id_like from t_like tl,tbl_uploads tblup, t_statistique ts, produit p, user u where 
ts.id_file=tblup.id_file
and tblup.id_produit=p.id_produit
and tl.id_user=u.id_user group by u.name";
$reqExec = mysql_query($query);

$Stat;

while ($Stat[] = mysql_fetch_assoc($reqExec)) {

}

$jsonEncode = json_encode($Stat);

echo "{" . "\"d\"" . ":" . $jsonEncode . "}";
?>