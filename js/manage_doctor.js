$("document").ready(function(){
	if(sessionStorage.getItem("UserLogged") == null){
		alert("Permission non accordée !\nVeuillez saisir vos paramètres d'accès");
		
		window.location.replace("index.html");
		sessionStorage.clear();
	}else{
  $("#register-form").submit(function(){
    var data = {
      "name": $("#name").val(),
      "surname": $("#surname").val(),
      "tel": $("#tel").val(),
      "fax": $("#fax").val(),
      "adresse": $("#adresse").val(),
      "email": $("#email").val(),

    };
    
    //data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
    	
      type: "POST",
      dataType: "json",
      url: "../E-adv/server/addDoctor.php", //Relative or absolute path
      data: data,
      success: function(data) {
      	var d = $.parseJSON(JSON.stringify(data)).response;
      	alert(d);

				if (d == "Successfully Registered!") {

					window.location.replace("listDoctor.html");
				}

       // alert("Form submitted successfully.\nReturned json: " + data["json"]);
      }
    });
    return false;
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




