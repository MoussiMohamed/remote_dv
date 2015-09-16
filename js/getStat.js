$(document).ready(function() {
	if(sessionStorage.getItem("UserLogged") == null
	|| sessionStorage.getItem("UserAuthorized") == "Utilisateur non autorisé !"){
		alert("Permission non accordée !\nVeuillez saisir vos paramètres d'accès");
		window.open("index.html","_top");
		//window.location.replace("index.html","_top");
		sessionStorage.clear();
	}else{

	$.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "../E-adv/server/getStat.php",             
        dataType: "json",   //expect json to be returned                
        success: function(response){                    
          
            var t = $('#myTable').DataTable();
            
            for (var i = 0; i < response.d.length-1; i++) { 
            	
                t.row.add( [
                    
                    response.d[i].id_user,
                    response.d[i].name,
                    '<input type="button"  class="btn btn-primary btn-xs" onClick="javascript:getComment(this)" value = "Voir Rapport" >'
                ] ).draw();
              
            }
        }

    });
	
 }
});

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

function getComment(obj){
    var t = document.getElementById("myTable");
    
    var rowCounts = t.rows.length;
    
	var row = t.insertRow(rowCounts);

var indexs = obj.parentNode.parentNode.rowIndex;
var id_delegue = t.rows[indexs].cells[0].innerHTML;
var nom_delegue = t.rows[indexs].cells[1].innerHTML;
sessionStorage.setItem("id_delegue", id_delegue);
sessionStorage.setItem("nom_delegue", nom_delegue);
window.location.replace("detailStat.html","_top");

}




