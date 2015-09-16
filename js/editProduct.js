function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}

function changeScreanToEdit(id_Produit){
	var table = document.getElementById("myTable");
            var rowCount = table.rows.length;
            
    		var row = table.insertRow(rowCount);
    
    var index = id_Produit.parentNode.parentNode.rowIndex;
	var elemtIdProduit = table.rows[index].cells[0].innerHTML;
	var elemtNameProduit = table.rows[index].cells[1].innerHTML;
	
	// Store
sessionStorage.setItem("id_Produit", elemtIdProduit);
sessionStorage.setItem("nomProduit", elemtNameProduit);


	window.location.replace("editProduct.html");
}
function doEditProduct(){
	 // Create our XMLHttpRequest object
    updReq = getXMLHttp();
    // Create some variables we need to send to our PHP file
    var url = "../E-adv/server/editProduct.php";
    var id_Prod = sessionStorage.getItem("id_Produit");
    var nameProduct = document.getElementById("nameProduct").value;
    var vars = "id_Product="+id_Prod+"&nameProduct="+nameProduct;
    
	updReq.open('POST', url, true);
        updReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
       
        updReq.onreadystatechange = function() {//Call a function when the state changes.
                if(updReq.readyState == 4 && updReq.status == 200) {
                	//HandleResponseEdit(updReq.responseText);
                        
                        window.location.replace("listProduct.html");
                }
        }
        updReq.send(vars);

}

function doGetDataForEdit(){
	if(sessionStorage.getItem("UserLogged") == null
	|| sessionStorage.getItem("UserAuthorized") == "Utilisateur non autorisé !"){
		alert("Permission non accordée !\nVeuillez saisir vos paramètres d'accès");
		window.open("index.html","_top");
		//window.location.replace("index.html","_top");
		sessionStorage.clear();
	}
	 document.getElementById("id_Produit").innerHTML = sessionStorage.getItem("id_Produit");
    document.getElementById("nameProduct").value = sessionStorage.getItem("nomProduit"); 
    
}

// HandleResponse
function HandleResponseEdit(response)
{
  document.getElementById('ResponseDiv').innerHTML = response;
}



