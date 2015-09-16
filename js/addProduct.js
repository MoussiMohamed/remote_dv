$("document").ready(function(){
  $("#addProduct-form").submit(function(){
    var data = {
      "nameProduct": $("#nameProduct").val(),

    };
    
    //data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
    	
      type: "POST",
      dataType: "json",
      url: "../E-adv/server/addProduct.php", //Relative or absolute path to response.php file
      data: data,
      success: function(data) {
      	var d = $.parseJSON(JSON.stringify(data)).response;
      	

				if (d == "Successfully Registered!") {

					window.location.replace("listProduct.html");
				}

       // alert("Form submitted successfully.\nReturned json: " + data["json"]);
      }
    });
    return false;
  });
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




