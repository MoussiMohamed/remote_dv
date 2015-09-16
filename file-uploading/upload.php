
<?php

include_once 'dbconfig.php';

if(isset($_POST['btn-upload']) && isset($_POST['contentType']) )
{    
    $idProd = $_POST['idProd'];
	$content_type = $_POST['contentType'];
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
	$file_size = $_FILES['file']['size'];
	
	if($file_size == null){
		
		?>
		<script>
		alert('Veuillez selectionner un fichier');
		
        window.location.href='index.php?fail';
        </script>
        <?php
	}
	else
	{
    $file_loc = $_FILES['file']['tmp_name'];
	
	$file_type = $_FILES['file']['type'];
	
	$folder="uploads/";
	$fileData =addslashes(file_get_contents($_FILES['file']['tmp_name']));
	
	$fileProperties = getimageSize($_FILES['file']['tmp_name']);
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	if($content_type == "vide"){
			?>
		<script>
		alert('Veuillez selectionner un type de contenu');
		
        window.location.href='index.php?fail';
        </script>
        <?php
		
	}else
	{
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO tbl_uploads(file,type,size,content_type,id_produit)
		VALUES('$final_file','$file_type','$new_size','$content_type','$idProd')";
		mysql_query($sql);
		
		
		?>
		<script>
				
        window.location.href='index.php?success';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
         window.location.href='index.php?fail';
        </script>
		<?php
	}
	}
}

}
?>