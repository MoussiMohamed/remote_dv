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
var email="";
function doAuthentif(){
	 // Create our XMLHttpRequest object
    updReq = getXMLHttp();
    // Create some variables we need to send to our PHP file
    var url = "../E-adv/server/authentif.php";
    

    email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
if(email == "" && password == "")
{
	alert("Veuillez entrer vous paramètres d'accès")
	}
	else{
    var vars = "email="+email+"&password="+password;
	updReq.open('POST', url, true);
        updReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
       
        updReq.onreadystatechange = function() {//Call a function when the state changes.
                if(updReq.readyState == 4 && updReq.status == 200) {
                       // HandleResponse(updReq.responseText);
                        if(updReq.responseText == "authentification reussie"){
                        	sessionStorage.setItem("UserLogged",email);
                        
                        window.location.replace("temp.html");
                        
                        }
                        else if(updReq.responseText == "Utilisateur non autorisé")
                        {
                        	sessionStorage.setItem("UserAuthorized","Utilisateur non autorisé !");
                        	alert(updReq.responseText);
                        	window.open("index.html","_top");
                        }
                        else{
                        	alert(updReq.responseText);
                        }
                }
        }
        updReq.send(vars);
       
       }


}
// HandleResponse
function HandleResponse(response)
{
  document.getElementById('ResponseAuth').innerHTML = response;
}



