<?php
//header('Access-Control-Allow-Origin: *');

   
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) ) {
	$name     = $_POST["name"];
	$surname   = $_POST["surname"];
	$tel   = $_POST["tel"];
	$fax   = $_POST["fax"];
	$adresse   = $_POST["adresse"];
	$email    = $_POST["email"];

	mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
	$query = mysql_query("Select * from medecin where email='$email'"); //Query the users table
	
	if(mysql_num_rows($query) == 1){
$data = array(
            "response"     => "Email address has been taken!",
            
        );
		echo json_encode($data);
	}else{
			$timestamp = date('Y-m-d G:i:s');

		$result = mysql_query("INSERT INTO medecin (name, surname, tel, fax, adresse, email, date_creation) VALUES ('$name','$surname','$tel','$fax', '$adresse','$email','$timestamp')"); //Inserts the value to table user

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