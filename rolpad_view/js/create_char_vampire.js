// Create char
player = 1;
chronicle=1;
$(function () {//Ready


$('#newchar').click(function(){

	$.ajax({
			type: "POST",
			url: site + "create_char_vampire.php",
			data: "player="+ player +"&chronicle=" + chronicle
		}).done(function(response) {

				var data = $.parseJSON(response);

				$(data).each(function(i,val)
				 {
				    $.each(val,function(key,val)
				  {
				     if(key=="id")
				     {				          		
				        window.location.replace("vampire/index.html?id="+val);  		
				     }else{//ERROR
				     	alert("No se pudo crear el vampiro intente nuevamente.");
				     }    
				  });
				});
				// similar behavior as an HTTP redirect
				//window.location.replace("http://stackoverflow.com");

				// similar behavior as clicking on a link
				//window.location.href = "http://stackoverflow.com";

				//$("#displayCliente").html(html).show();
				//loadingName.style.display = "none";
		}).fail(function(jqXHR) {
		  console.log(jqXHR.statusText);
	});
	
	
});//end onclick



});//end ready