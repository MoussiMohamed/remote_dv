<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
$idDelegue = $_POST['id_delegue'];
//Connect to database
$query = "select ts.id_file, tblup.file,p.nom_Produit,count(ts.nbr_visite) as nbr_visite,ts.date_visite,ts.temps_passe,
count(tl.id_like) as nbr_like from t_like tl,tbl_uploads tblup, t_statistique ts, produit p, user u where 
ts.id_file=tblup.id_file
and tblup.id_produit=p.id_produit
and tl.id_user=u.id_user
and tl.id_user='$idDelegue' group by tblup.file";

$reqExec = mysql_query($query);

$commentaire;

while ($commentaire[] = mysql_fetch_assoc($reqExec)) {

}

$jsonEncode = json_encode($commentaire);

echo "{" . "\"d\"" . ":" . $jsonEncode . "}";
?>