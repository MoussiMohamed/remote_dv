<?php
include_once 'dbconfig.php';

if(isset($_POST['fileId']) && isset($_POST['fileName'])){
	
	$fileId=$_POST['fileId'];
	$fileName=$_POST['fileName'];
	
	$sql="delete from tbl_uploads where id_file='$fileId'";
	
	$result_set=mysql_query($sql);
	if(!$result_set){
		echo "Echec de suppression de fichier ".mysql_error() ;
	}else{
		unlink("uploads/".$fileName);
		echo "Fichier a été supprimé avec succès";
	}
	
}else
{
	echo "data missed";
}

?>