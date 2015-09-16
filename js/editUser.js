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

function changeScreanToEdit(id_User){
	var table = document.getElementById("myTable");
            var rowCount = table.rows.length;
            
    		var row = table.insertRow(rowCount);
    
    var index = id_User.parentNode.parentNode.rowIndex;
	var elemt = table.rows[index].cells[0].innerHTML;
	var elemtName = table.rows[index].cells[1].innerHTML;
	var elemtSurname = table.rows[index].cells[2].innerHTML;
	var elemtTel = table.rows[index].cells[3].innerHTML;
	var elemtFax = table.rows[index].cells[4].innerHTML;
	var elemtAdresse = table.rows[index].cells[5].innerHTML;
	var elemtEmail = table.rows[index].cells[6].innerHTML;
	var elemtPassword = table.rows[index].cells[7].innerHTML;
	// Store
sessionStorage.setItem("id_User", elemt);
sessionStorage.setItem("name", elemtName);
sessionStorage.setItem("surname", elemtSurname);
sessionStorage.setItem("tel", elemtTel);
sessionStorage.setItem("fax", elemtFax);
sessionStorage.setItem("adresse", elemtAdresse);
sessionStorage.setItem("email", elemtEmail);
sessionStorage.setItem("password", elemtPassword);

	window.location.replace("editUser.html");
}
function doEditUser(){
	 // Create our XMLHttpRequest object
    updReq = getXMLHttp();
    // Create some variables we need to send to our PHP file
    var url = "../E-adv/server/editUser.php";
    var id_Usr = sessionStorage.getItem("id_User");
    var name = document.getElementById("name").value;
    var surname = document.getElementById("surname").value;
    var tel = document.getElementById("tel").value;
    var fax = document.getElementById("fax").value;
    var adresse = document.getElementById("adresse").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var vars = "id_Usr="+id_Usr+"&name="+name+"&surname="+surname+"&email="+email+"&password="+password;
    
	updReq.open('POST', url, true);
        updReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
       
        updReq.onreadystatechange = function() {//Call a function when the state changes.
                if(updReq.readyState == 4 && updReq.status == 200) {
                	//HandleResponseEdit(updReq.responseText);
                        
                        window.location.replace("home.html");
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
	 
    document.getElementById("name").value = sessionStorage.getItem("name");
    document.getElementById("surname").value = sessionStorage.getItem("surname");
    document.getElementById("tel").value = sessionStorage.getItem("tel");
    document.getElementById("fax").value = sessionStorage.getItem("fax");
    document.getElementById("adresse").value = sessionStorage.getItem("adresse");
    document.getElementById("email").value = sessionStorage.getItem("email");
    document.getElementById("password").value = sessionStorage.getItem("password");
}

// HandleResponse
function HandleResponseEdit(response)
{
  document.getElementById('ResponseDiv').innerHTML = response;
}



