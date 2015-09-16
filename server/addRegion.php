<?php
//header('Access-Control-Allow-Origin: *');

   
    if(isset($_POST['nom_region']) ) {
	$nom_region     = $_POST["nom_region"];
	

	mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
	$query = mysql_query("Select * from region where nom_region='$nom_region'"); //Query the users table
	
	if(mysql_num_rows($query) == 1){
$data = array(
            "response"     => "Region exist déja!",
            
        );
		echo json_encode($data);
	}else{
			$timestamp = date('Y-m-d G:i:s');

		$result = mysql_query("INSERT INTO region (nom_region, date_creation) VALUES ('$nom_region','$timestamp')"); //Inserts the value to table user

if (!$result) {
    die('Requête invalide : ' . mysql_error());
}	
$data = array(
            "response"     => "Successfully Registered!",
            
        );
		
		echo json_encode($data);
		}
	


}
else {
	
	$data = array(
            "response"     => "data missed",
            
        );
		echo json_encode($data);
}

?>