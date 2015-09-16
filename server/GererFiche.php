<?php

header('Access-Control-Allow-Origin: *');
require_once 'db.class.php';

function afficheFiches($db,$obj){
	$where = "";
	if(isset($obj->{'id_employe'})){
	$id_employe=$obj->{'id_employe'};
	//$db=new DBConnection('localhost','root','','db_sav');
	
	$where = "and emp.id_employe= ".$id_employe;
	
	
// 	$req="select * from fiche f,
// employe emp, attribution_fiche att_f,
// 	materiel m,
// 	client cl,
// 	attribution_etat_fiche attrib_etat_f,
// 	etat_fiche etat_f where
// 	f.id_client=cl.id_client
// 	and f.id_materiel=m.id_materiel
// 	and attrib_etat_f.id_fiche=f.id_fiche
// 	and attrib_etat_f.id_etat_fiche=etat_f.id_etat_fiche
// and att_f.id_employe=emp.id_employe
// and att_f.id_fiche=f.id_fiche ".$where;

	
	$req="select f.id_fiche,emp.nom_Emp from fiche f,
	employe emp, attribution_fiche att_f,
		materiel m,
		client cl,
		attribution_etat_fiche attrib_etat_f,
		etat_fiche etat_f where
		f.id_client=cl.id_client
		and f.id_materiel=m.id_materiel
		and attrib_etat_f.id_fiche=f.id_fiche
		and attrib_etat_f.id_etat_fiche=etat_f.id_etat_fiche
	and att_f.id_employe=emp.id_employe
	and att_f.id_fiche=f.id_fiche ".$where;
	
	
	
	
	$reqExe=$db->rq($req);
	
	$jsonEncode="";
	$fiches;
	
	while($fiches[]=$db->fetch($reqExe)){
	
	}
	
	$s= count($fiches);
	unset($fiches[$s-1]);
	
	$jsonEncode  = json_encode($fiches);


	$wrapper="isc.Comm._scriptIncludeReply_0";
	if(isset($_GET['callback'])){
		$wrapper= $_GET['callback'];
	}


	echo "$wrapper({"."\"d\"".":".$jsonEncode."})";
	}
else{
	$req="select * from fiche f,
	materiel m,
	client cl,
	attribution_etat_fiche attrib_etat_f,
	etat_fiche etat_f where
	f.id_client=cl.id_client
	and f.id_materiel=m.id_materiel
	and attrib_etat_f.id_fiche=f.id_fiche
	and attrib_etat_f.id_etat_fiche=etat_f.id_etat_fiche";

	$reqExe=$db->rq($req);

	$jsonEncode="";
	$fiches;

	while($fiches[]=$db->fetch($reqExe)){

	}

	$jsonEncode  = json_encode($fiches);

	echo "{"."\"d\"".":".$jsonEncode."}";

}
}
// }
// }

function AfficheTechnicien($db,$obj){

	$Action=$obj->{'Action'};

	$resTechnicien="select * from employe";
	$resultatTechnicien=$db->rq($resTechnicien);

	$jsonEncode="";
	$Employe;
	while($Employe[]=$db->fetch($resultatTechnicien)){

	}

	$jsonEncode  = json_encode($Employe);
	echo "{"."\"d\"".":".$jsonEncode."}";

}

	function Insert($obj,$db){
		
		
		$date_attrib_etat_fiche="";//date serveur
		$NomC=$obj->{'NomClient'};
		$PrenomC=$obj->{'PrenomClient'};
		$AdresseC=$obj->{'AdresseClient'};
		$NumTelProtC=$obj->{'NumTelPortClient'};
		$NumTelFixClient=$obj->{'NumTelFixClient'};
		$EmailC=$obj->{'Email'};
		$MotPasseC=$obj->{'MotPasse'};
		$Modele=$obj->{'Modele'};
		$Marque=$obj->{'Marque'};
		$NumSerie=$obj->{'NumSerie'};
		$StatMat=$obj->{'statutMateriel'};
		$commentaire_etat_F=$obj->{'commentaire_etat_Fiche'};
		$dateCreationFiche=$obj->{'dateCreationFiche'};
		$EtatFiche=$obj->{'EtatFiche'};
		$DescPanne=$obj->{'DescPanne'};
		
		
		
		//insertion data in table client
		$db=new DBConnection('127.0.0.1:8880','root','','db_sav');
	$resInsCl="insert into client(nom_Client,prenom_client,adresse,num_tel_port,num_tel_fix,email,mot_passe) 
	values('$NomC','$PrenomC','$AdresseC','$NumTelProtC','$NumTelFixClient','$EmailC','$MotPasseC')";
	$resultat=$db->rq($resInsCl);
	$res_id_client = $db->last_id();
	
		//insertion data in table materiel
		$resMateriel="insert into materiel(modele,marque,numero_serie,statut_materiel) values('$Modele','$Marque','$NumSerie','$StatMat')";
		$resExecuteMateriel=$db->rq($resMateriel);
		$resIdMateriel = $db->last_id();
	
		//insertion data in table fiche
		$resFiche="insert into fiche(date_creation_fiche,id_client,description_panne,id_materiel) values('$dateCreationFiche','$res_id_client','$DescPanne','$resIdMateriel')";
		$resExecuteFiche=$db->rq($resFiche);
		$res_id_fiche = $db->last_id();
	
		//insertion data in table etat_materiel
		$resEtatF="insert into etat_fiche(nom_etat,commentaire_etat) values ('$EtatFiche','$commentaire_etat_F')";
		$resExecEtatF=$db->rq($resEtatF);
		$res_id_etat_materiel = $db->last_id();
	
		$resAttrib_Etat_f="insert into attribution_etat_fiche values('$res_id_fiche','$res_id_etat_materiel','$date_attrib_etat_fiche')";
		$resExecAttribEtatFiche=$db->rq($resAttrib_Etat_f);
	
	
}

function afficheFiche($obj,$db){

$id_fiche=$obj->{'IdFiche'};

	$req="SELECT * 
FROM client, materiel,attribution_etat_fiche, etat_fiche, fiche
LEFT JOIN attribution_devis_reparation ON attribution_devis_reparation.id_fiche = fiche.id_fiche
LEFT JOIN devis_reparation ON attribution_devis_reparation.id_devis_reparation = devis_reparation.id_devis_reparation
WHERE fiche.id_client = client.id_client
AND materiel.id_materiel = fiche.id_materiel
and attribution_etat_fiche.id_etat_fiche = etat_fiche.id_etat_fiche
AND fiche.id_fiche ='$id_fiche'";

	$reqExe=$db->rq($req);
	$jsonEncode="";
	$fiches;
	while($fiches[]=$db->fetch($reqExe)){

	}

	$jsonEncode  = json_encode($fiches);

	echo "{"."\"d\"".":".$jsonEncode."}";

}

function updateFiche($db,$obj){
	
	//r�cup�ration de valeurs
	
	$action=$obj->{'Action'};
	$idFiche=$obj->{'IdFiche'};
	$date_attrib_etat_fiche="";//date serveur
	$NomC=$obj->{'NomClient'};
	$PrenomC=$obj->{'PrenomClient'};
	$AdresseC=$obj->{'AdresseClient'};
	$NumTelProtC=$obj->{'NumTelPortClient'};
	$NumTelFixClient=$obj->{'NumTelFixClient'};
	$EmailC=$obj->{'Email'};
	$MotPasseC=$obj->{'MotPasse'};
	$Modele=$obj->{'Modele'};
	$Marque=$obj->{'Marque'};
	$NumSerie=$obj->{'NumSerie'};
	$StatMat=$obj->{'statutMateriel'};
	$commentaire_etat_F=$obj->{'commentaire_etat_Fiche'};
	$dateCreationFiche=$obj->{'dateCreationFiche'};
	$EtatFiche=$obj->{'EtatFiche'};
	$DescPanne=$obj->{'DescPanne'};
	
	//requette update fiche
	
	$reqEdit="update fiche,client,materiel,attribution_etat_fiche,etat_fiche
	set nom_Client='$NomC',
	prenom_client='$PrenomC',
	adresse='$AdresseC',
	num_tel_port='$NumTelProtC',
	num_tel_fix='$NumTelFixClient',
	email='$EmailC',
	mot_passe='$MotPasseC',
	date_creation_fiche='$dateCreationFiche',
	description_panne='$DescPanne',
	nom_etat='$EtatFiche',
	commentaire_etat='$commentaire_etat_F',
	modele='$Modele',
	marque='$Marque',
	numero_serie='$NumSerie',
	statut_materiel='$StatMat'
	where fiche.id_client=client.id_client
	and fiche.id_materiel=materiel.id_materiel
    and attribution_etat_fiche.id_fiche=fiche.id_fiche
	and attribution_etat_fiche.id_etat_fiche=etat_fiche.id_etat_fiche
	and fiche.id_fiche='$idFiche'";
	
	$resultat=$db->rq($reqEdit);
	
}

function addDevis($db,$obj){
	$idFiche=$obj->{'idFiche'};
	$rapport=$obj->{'Rapport'};
	$devis=$obj->{'Devis'};
	$commentDevis=$obj->{'CommentaireDevis'};
	$req="insert into devis_reparation (rapport_diagnostique,devis,commentaire_devis) values ('$rapport','$devis','$commentDevis')";
	$res=$db->rq($req);
	$lastIdDevis=$db->last_id();
	
	$reqattribDevis="insert into attribution_devis_reparation(id_fiche,id_devis_reparation) values('$idFiche','$lastIdDevis')";
	$resAttDevis=$db->rq($reqattribDevis);
	
	$req="select id_devis_reparation,rapport_diagnostique,devis,Commentaire_Devis from devis_reparation where id_devis_reparation='$lastIdDevis'";
	
	$resAffichDevis=$db->rq($req);
	
	$jsonEncode="";
	$fiches;
	
	while($fiches[]=$db->fetch($resAffichDevis)){
		$jsonEncode  = json_encode($fiches);
		
		echo "{"."\"d\"".":".$jsonEncode."}";
}

}


function selectDevis($db,$obj){
	$idDevis=$obj->{'idDevis'};
	$req="select id_devis_reparation,rapport_diagnostique,devis,Commentaire_Devis from devis_reparation where id_devis_reparation='$idDevis'";
	
	$resAffichDevis=$db->rq($req);
	
	$jsonEncode="";
	$fiches;
	
	while($fiches[]=$db->fetch($resAffichDevis)){
		$jsonEncode  = json_encode($fiches);
	
		echo "{"."\"d\"".":".$jsonEncode."}";
	}
}

function updateDevis($db,$obj){
	$idDevis=$obj->{'idDevis'};
	$rapport=$obj->{'Rapport'};
	$devis=$obj->{'Devis'};
	$commentDevis=$obj->{'CommentaireDevis'};

	$req="update devis_reparation 
	set rapport_diagnostique='$rapport',
	devis='$devis',
	Commentaire_Devis='$commentDevis' where id_devis_reparation='$idDevis'";
	$res=$db->rq($req);
	
	$req="select id_devis_reparation,rapport_diagnostique,devis,Commentaire_Devis from devis_reparation where id_devis_reparation='$idDevis'";
	
	$resAffichDevis=$db->rq($req);
	
	$jsonEncode="";
	$fiches;
	
	while($fiches[]=$db->fetch($resAffichDevis)){
		$jsonEncode  = json_encode($fiches);
	
		echo "{"."\"d\"".":".$jsonEncode."}";
	}
}

function authentif($db,$obj){
	$login=$obj->{'login'};
	$password=$obj->{'pwd'};
	$req="select * from employe emp, attribution_role att_rol,role r
where att_rol.id_employe=emp.id_employe
and att_rol.id_role=r.id_role
and emp.emailEmp='$login'
and emp.passwordEmp='$password'";
	$res=$db->rq($req);
	$jsonEncode="";
	$fiches;
		while($fiches[]=$db->fetch($res)){
			
			$jsonEncode  = json_encode($fiches);
		
		echo "{"."\"d\"".":".$jsonEncode."}";
					}
	
}


function Assignation($db,$obj){
	$idTechnicien=$obj->{'id_technicien'};
	$idFiche=$obj->{'id_fiche'};
	$reqAssigner="insert into attribution_fiche(id_employe,id_fiche) values ('$idTechnicien','$idFiche')";
	$resultat=$db->rq($reqAssigner);
}



function TesterChamps($db,$obj){
	$DescritonPanne=$obj->{'DescriptionPanne'};
	echo $DescritonPanne;
}

function getFicheClient($db,$obj){
	$idFiche=$obj->{'idFiche'};
	$req="select *
	from fiche F,client C, materiel MT, etat_fiche ET_F, attribution_etat_fiche ATT_ET_F,
	attribution_devis_reparation ATT_DV_RP,
	devis_reparation DV_RP
	where F.id_client=C.id_client
	and F.id_materiel=MT.id_materiel
	and F.id_fiche=ATT_ET_F.id_fiche
	and ATT_ET_F.id_etat_fiche=ET_F.id_etat_fiche
	and F.id_fiche=ATT_DV_RP.id_fiche
	and ATT_DV_RP.id_devis_reparation=DV_RP.id_devis_reparation
	and F.id_fiche='$idFiche'";

	$res=$db->rq($req);
	$jsonEncode="";
	$fiches;
	while($fiches[]=$db->fetch($res)){
			
		$jsonEncode  = json_encode($fiches);

		echo "{"."\"d\"".":".$jsonEncode."}";
	}



}
	

function AcceptDevis($db,$obj){
	$idFicheDevis=$obj->{'idFicheDevis'};
	$etatDevis=$obj->{'Etat_Devis'};
	$req="update devis_reparation devis_rep,attribution_devis_reparation att_devis
	set devis_rep.Etat_Devis='$etatDevis'
	where att_devis.id_devis_reparation=devis_rep.id_devis_reparation
	and att_devis.id_fiche='$idFicheDevis'";

	$res=$db->rq($req);
}

?>