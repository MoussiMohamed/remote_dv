<?php
header('Access-Control-Allow-Origin: *');
	
	session_start();
	$email = ($_POST['email']);
	$password = ($_POST['password']);

	mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
	
	$StringQuery="
	select * from user u left join attrib_role_user aru on aru.id_user = u.id_user
	left join role r on aru.id_role = r.id_role
	where u.email='$email' and u.password='$password'";
	//Query the users table if there are matching rows equal to $email and $password
	$query = mysql_query($StringQuery); 
	
	$exists = mysql_num_rows($query); //Checks if username exists
	
	if($exists > 0) //IF there are no returning rows or no existing email
		{		
			$row = mysql_fetch_row($query);
			
			if($row[9] == null){
				echo "Utilisateur non autorisé !";
			}else
			{
				echo "authentification reussie";
			}
		}
		else
		{
			echo "Incorrect Email Address and/or Password!"; //Prompts authentication error message
			
			 
		}

	
	
?>