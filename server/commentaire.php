<?php
header('Access-Control-Allow-Origin: *');
   
    if(isset($_POST['CommentTable']) ){
	$CommentTable     = $_POST["CommentTable"];
    mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
		
	$test= stripslashes($CommentTable);

	// Convert JSON string to Array
  $someArray = json_decode($test, true);
$length=count($someArray);
for($i=0; $i<$length; $i++){
$idcom=$someArray[$i]["id_com"];
$numPage=$someArray[$i]["num_page"];
$dateCom=$someArray[$i]["date_com"];
$commentaire=$someArray[$i]["commentaire"];
$NomMedecin=$someArray[$i]["nom_medecin"];
$idUser=$someArray[$i]["id_user"];
$idFile=$someArray[$i]["id_file"];

	$sqlString="insert into t_comment values('$idcom','$numPage','$dateCom','$commentaire','$NomMedecin','$idUser','$idFile') ON DUPLICATE KEY UPDATE nom_medecin='$NomMedecin'";
echo $sqlString;
  mysql_query($sqlString) or die(mysql_error());

}


}
else {
	echo "data missed";
	
}
	
?>