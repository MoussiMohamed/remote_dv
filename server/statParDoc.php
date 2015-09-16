<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
$id_document = $_POST['id_document'];
//Connect to database
$query = "select ts.id_file,ts.date_visite,tl.nom_medecin,ts.temps_passe
from t_like tl,tbl_uploads tblup, t_statistique ts, produit p, user u where 
ts.id_file=tblup.id_file
and tblup.id_produit=p.id_produit
and tl.id_user=u.id_user
and ts.id_file='$id_document'";

$reqExec = mysql_query($query);

$commentaire;

while ($commentaire[] = mysql_fetch_assoc($reqExec)) {

}

$jsonEncode = json_encode($commentaire);

echo "{" . "\"d\"" . ":" . $jsonEncode . "}";
?>