<?php
header('Access-Control-Allow-Origin: *');
require_once 'db.class.php';
require_once 'GererFiche.php';
require_once 'GererEmploye.php';
require_once 'ParametreSAV.php';
require_once 'Statistic.php';
// require_once 'getFicheClient.php';

$db=new DBConnection('127.0.0.1:8880','root','','db_sav');
if(isset($_POST['jsonObj'])){

	$obj = json_decode($_POST['jsonObj']);
	$action=$obj->{'Action'};
}else if (isset($_GET['Action'])){
	$params = array('Action'=>$_GET['Action'],
 				 'id_employe'=>$_GET['id_employe']);

	$obj = (object) $params;
	$action=$obj->{'Action'};

}else {
	echo"data missed";
	return;
}


Switch ($action){

	case "InsertFiche":          Insert($obj,$db);break;

	case "afficheFiches":        afficheFiches($db,$obj);break;

	case "AfficheFiche":         afficheFiche($obj,$db);break;

	case "AfficheTechnicien":    AfficheTechnicien($db,$obj);break;

	case "updateFiche":          updateFiche($db,$obj);break;

	case "addDevis":             addDevis($db,$obj);break;

	case "selectDevis":  		 selectDevis($db,$obj);break;

	case "updateDevis":			 updateDevis($db,$obj);break;

	case "authentification":     authentif($db,$obj);break;

	case "AssignerFiche":        Assignation($db,$obj);break;

	case "AddEmploye":			 addEmploye($db,$obj);break;

	case "DisplayEmploye":       DisplayLstEmploye($obj,$db);break;

	case "AddPrivilege":         AddPrivilege($db,$obj);break;

	case "AffichePrivilege":     AffichePrivilege($db,$obj);break;

	case "DeletePrivilege":		deletePrivilege($db,$obj);break;

	case "getFicheStatus":  	getFicheStatus($db);break;
	
	case "leftMenu":  			getLeftMenu($db,$obj);break;
	
	case "FicheClient":		     getFicheClient($db,$obj);break;
	
	case "AcceptDevis":    		 AcceptDevis($db,$obj);break;
	
	

}





?>