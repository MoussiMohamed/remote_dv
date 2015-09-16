<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
$idFile = $_POST['id_fiche'];
//Connect to database
$query = "select * from t_comment tc,tbl_uploads tblup, user u where tc.id_file=tblup.id_file
and u.id_user=tc.id_user and tc.id_file='$idFile'";

$reqExec = mysql_query($query);

$commentaire;

while ($commentaire[] = mysql_fetch_assoc($reqExec)) {

}

$jsonEncode = json_encode($commentaire);

echo "{" . "\"d\"" . ":" . $jsonEncode . "}";
?>