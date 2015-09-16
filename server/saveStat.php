<?php
header('Access-Control-Allow-Origin: *');
   
    if(isset($_POST['statisticTable']) ){
	$statisticTable     = $_POST["statisticTable"];
    mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
		
	$test= stripslashes($statisticTable);

	// Convert JSON string to Array
  $someArray = json_decode($test, true);

$length=count($someArray);
for($i=0; $i<$length; $i++){
$id_statistique=$someArray[$i]["id_statistique"];
$date_visite=$someArray[$i]["date_visite"];
$nbr_visite=$someArray[$i]["nbr_visite"];
$temps_passe=$someArray[$i]["temps_passe"];
$id_file=$someArray[$i]["id_file"];
	$sqlString="insert into t_statistique(id_statistique,date_visite,nbr_visite,temps_passe,id_file) values('$id_statistique','$date_visite','$nbr_visite','$temps_passe','$id_file') ON DUPLICATE KEY UPDATE temps_passe='$temps_passe'";

  mysql_query($sqlString) or die(mysql_error());

}


}
else {
	echo "data missed";
	
}
	
?>