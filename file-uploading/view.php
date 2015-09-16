<?php
header('Access-Control-Allow-Origin: *');
include_once 'dbconfig.php';

if(isset($_POST['idProduit'])){
	
$idP=$_POST['idProduit'];


$query="SELECT * FROM tbl_uploads where id_produit='$idP'";
$reqExec = mysql_query($query);

$files;

while ($files[] = mysql_fetch_assoc($reqExec)) {

}

$jsonEncode = json_encode($files);

echo "{" . "\"d\"" . ":" . $jsonEncode . "}";
}else{
	$query="SELECT * FROM tbl_uploads";
$reqExec = mysql_query($query);

$files;

while ($files[] = mysql_fetch_assoc($reqExec)) {

}

$jsonEncode = json_encode($files);

echo "{" . "\"d\"" . ":" . $jsonEncode . "}";
}
?>













