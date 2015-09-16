$(document).ready(function() {
	if(sessionStorage.getItem("UserLogged") == null
	|| sessionStorage.getItem("UserAuthorized") == "Utilisateur non autorisé !"){
		alert("Permission non accordée !\nVeuillez saisir vos paramètres d'accès");
		window.open("index.html","_top");
		//window.location.replace("index.html","_top");
		sessionStorage.clear();
	}else{

	$.ajax({    
        type: "GET",
        url: "../E-adv/server/getCommentaire.php",             
        dataType: "json",   //expect json to be returned                
        success: function(response){                    
          
            var t = $('#myTable').DataTable();
            
            for (var i = 0; i < response.d.length-1; i++) { 
            	
                t.row.add( [
                    response.d[i].id_file,
                    response.d[i].file,
                    response.d[i].content_type,
                    '<input type="button"  class="btn btn-primary btn-xs" onClick="javascript:getComment(this)" value = "Voir Commentaires" >'

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

function getIdComment(obj){

    var t = document.getElementById("myTable");
    
    var rowCounts = t.rows.length;
    
	var row = t.insertRow(rowCounts);

var indexs = obj.parentNode.parentNode.rowIndex;
var elemts = t.rows[indexs].cells[0].innerHTML;

sessionStorage.setItem("idComment",elemts);
sessionStorage.setItem("selectedRowIndex",indexs);
}


function getComment(obj){
    var t = document.getElementById("myTable");
    
    var rowCounts = t.rows.length;
    
	var row = t.insertRow(rowCounts);

var indexs = obj.parentNode.parentNode.rowIndex;
var id_file = t.rows[indexs].cells[0].innerHTML;
var file_name = t.rows[indexs].cells[1].innerHTML;
sessionStorage.setItem("id_file", id_file);
sessionStorage.setItem("file_name", file_name);
window.location.replace("detailComment.html","_top");

}


function deleteRow(selectedRow,idComment) {
    var table = document.getElementById("myTable");
            var rowCount = table.rows.length;

updReq = getXMLHttp();
    // Create some variables we need to send to our PHP file
    var url = "../E-adv/server/deleteComment.php";
    
	updReq.open('POST', url, true);
        updReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        var vars="id_Comment="+idComment;
        updReq.onreadystatechange = function() {//Call a function when the state changes.
                if(updReq.readyState == 4 && updReq.status == 200) {
//HandleResponseDelete(updReq.responseText);

table.deleteRow(selectedRow);


   
    }
        }
        updReq.send(vars);
    
    
    
}

/*
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
*/



