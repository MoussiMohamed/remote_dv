<?php
    header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
$id_Produit=($_POST['index']);

	mysql_connect("10.0.210.173", "moha","moha") or die(mysql_error()); //Connect to server
	mysql_select_db("db_e_adv") or die("Cannot connect to database"); //Connect to database
	
	$query="delete p.*, up.* from produit p left join tbl_uploads up
	on p.id_produit = up.id_produit
	where (p.id_produit = '$id_Produit');";
	$reqExec=mysql_query($query);
	if(!$reqExec){
		echo "echec de suppression de produit, ".mysql_error();
	}
	else
	{
		
	$fileName_rs= "select file from tbl_uploads where id_produit='$id_Produit'";
	if(!$fileName_rs){
		echo "Aucun fichier trouvé lié à ce produit !";
	}else{
		
	while($row=mysql_fetch_array($fileName_rs))
	{
		unlink("../file-uploading/uploads/".$row['file']);
	}
	}
	echo "Produit a été supprimé avec succès";
	}

mysql_close();
?>