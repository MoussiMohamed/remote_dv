<?php
header('Access-Control-Allow-Origin: *');
   
    if(isset($_POST['LikeTable']) ){
	$LikeTable     = $_POST["LikeTable"];
    mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
		
	$cleanLike= stripslashes($LikeTable);

	// Convert JSON string to Array
  $someArray = json_decode($cleanLike, true);
$length=count($someArray);
for($i=0; $i<$length; $i++){
$idLike=$someArray[$i]["id_like"];
$numPage=$someArray[$i]["num_page"];
$dateLike=$someArray[$i]["date_like"];
$NomMedecin=$someArray[$i]["nom_medecin"];
$idUser=$someArray[$i]["id_user"];
$idFile=$someArray[$i]["id_file"];

	$sqlString="insert into t_like values('$idLike','$numPage','$dateLike','$NomMedecin','$idUser','$idFile') ON DUPLICATE KEY UPDATE nom_medecin='$NomMedecin'";

  mysql_query($sqlString) or die(mysql_error());

}


}
else {
	echo "data missed";
	
}
	
?>