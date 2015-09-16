$("document").ready(function(){
	if(sessionStorage.getItem("UserLogged") == null){
		alert("Permission non accordée !\nVeuillez saisir vos paramètres d'accès");
		
		window.location.replace("index.html");
		sessionStorage.clear();
	}else{
  $("#register-form").submit(function(){
    var data = {
      "nom_region": $("#nom_region").val(),

    };
    
    //data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
    	
      type: "POST",
      dataType: "json",
      url: "../E-adv/server/addRegion.php", //Relative or absolute path
      data: data,
      success: function(data) {
      	var d = $.parseJSON(JSON.stringify(data)).response;
      	alert(d);

				if (d == "Successfully Registered!") {

					window.location.replace("listRegion.html");
				}

       // alert("Form submitted successfully.\nReturned json: " + data["json"]);
      }
    });
    return false;
  });
 }
});






