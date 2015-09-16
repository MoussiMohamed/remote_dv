$(document).ready(function() {
	if(sessionStorage.getItem("UserLogged") == null 
	|| sessionStorage.getItem("UserAuthorized") == "Utilisateur non autorisé !"){
		alert("Permission non accordée !\nVeuillez saisir vos paramètres d'accès");
	
		window.open("index.html","_top");
		sessionStorage.clear();
	}else{
	
	$.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "../E-adv/server/listProduct.php",             
        dataType: "json",   //expect json to be returned                
        success: function(response){                    
          
            var t = $('#myTable').DataTable();
            
            
            for (var i = 0; i < response.d.length-1; i++) { 
            	
                t.row.add( [
                    response.d[i].id_Produit,
                    response.d[i].nom_Produit,
                    response.d[i].date_Insertion,
                    response.d[i].date_Modification,
                    '<input type="button"  class="btn btn-primary btn-xs" value = "Modifier" onClick="Javascript:changeScreanToEdit(this)" >',
                    '<input type="button" class="btn btn-danger btn-xs" value = "Supprimer" data-title="Delete" data-toggle="modal" onClick="Javascript:getIdProduit(this)" data-target="#delete" >',
                    '<input type="button"  class="btn btn-primary btn-xs" value = "Ajouter documents" onClick="Javascript:changeScreanToAddPDF(this)" >',
                    '<input type="button"  class="form-control btn btn-login" value = "Afficher documents" onClick="Javascript:changeScreanToViewPDF(this)" >'
                ] ).draw();
         
            }
        }

    });
	
 }
} );


function logOut(){
	
	sessionStorage.clear();
	window.location.replace("index.html");
}

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


// HandleResponse
function HandleResponse(response)
{
  document.getElementById('responseHome').innerHTML = response;
}

function getIdProduit(obj){
    var t = document.getElementById("myTable");
    
    var rowCounts = t.rows.length;
    
	var row = t.insertRow(rowCounts);

var indexs = obj.parentNode.parentNode.rowIndex;
var elemts = t.rows[indexs].cells[0].innerHTML;

sessionStorage.setItem("idProduit",elemts);
sessionStorage.setItem("selectedRowIndex",indexs);
}


function deleteRow(selectedRow,idProduit) {
    var table = document.getElementById("myTable");
            var rowCount = table.rows.length;

updReq = getXMLHttp();
    // Create some variables we need to send to our PHP file
    var url = "../E-adv/server/deleteProduct.php";
    
	updReq.open('POST', url, true);
        updReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        var vars="index="+idProduit;
       
        updReq.onreadystatechange = function() {//Call a function when the state changes.
                if(updReq.readyState == 4 && updReq.status == 200) {
//alert(updReq.responseText);

table.deleteRow(selectedRow);
   
    }
        }
        updReq.send(vars);
    
}


function editUser(obj) {
    var table = document.getElementById("myTable");
            var rowCount = table.rows.length;
            
    		var row = table.insertRow(rowCount);
    
    var index = obj.parentNode.parentNode.rowIndex;
	var elemt = table.rows[index].cells[0].innerHTML;

updReq = getXMLHttp();
    // Create some variables we need to send to our PHP file
    var url = "../E-adv/server/editUser.php";
    
    
	updReq.open('POST', url, true);
        updReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        var vars="index="+elemt;
        updReq.onreadystatechange = function() {//Call a function when the state changes.
                if(updReq.readyState == 4 && updReq.status == 200) {
//HandleResponse(updReq.responseText);

table.deleteRow(index);

   
    }
        }
        updReq.send(vars);
    
}

function HandleResponseDelete(response)
{
  document.getElementById('responseHome').innerHTML = response;
}


