<?php

include_once 'dbconfig.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>E-adv Gestion de Contenu</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="../bootstrap-3.3.4-dist/css/bootstrap.min.css">
</head>
<body onload="fillIdProd()">
	
		
<div id="header">
<label>Ajouter contenu </label>
</div>
<div id="body">
	<script>
			 function fillIdProd(){
			 var prodId = sessionStorage.getItem("id_Produit");
			 document.getElementById('idProd').value = prodId;
			 
			 }
			 
		</script>
	<form name="forma" action="upload.php" method="post" enctype="multipart/form-data">
	
	Type : <select name="contentType">
	<option value="vide">__________</option>
  	<option value="E-ADV">E-ADV</option>
  	<option value="Article">Article</option>
  	</select>
	<br><br>
	<input type="file" name="file" />
	
	<input type="text" style="display:none" id="idProd" name="idProd"  />
	<button type="submit" name="btn-upload" class="btn btn-success">upload</button>
	<a href="../listProduct.html" class="btn btn-danger">Annuler</a>
</form>
    <br /><br />
    <?php
	if(isset($_GET['success']))
	{
		?>
        <label style="color: green;">Téléchargement avec succès...  <a href="view.html">Veuillez cliquer ici pour voir les fichiers</a></label>
        <?php
	}
	else if(isset($_GET['fail']))
	{
		?>
        <label>Problem While File Uploading !</label>
        <?php
	}
	else
	{
		?>
        <label>Veuillez inserer un fichier (PDF)</label>
        <?php
	}
	?>
</div>
<div id="footer">
<label>By <a href="http://www.interactions.tn/">Interactions</a></label>
</div>
</body>
</html>