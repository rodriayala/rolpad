//vampire char onload view

var id_char = getParameterByName('id');

$(window).on('load', function () {//al principio de la carga seteo los valores actuales
      //alert(charId);
	$(function () {//Ready
      ///////////////////get basics
      	$.ajax({
			type: "POST",
			url: subsite + "view_char_vampire.php",
			data: "id_char="+ id_char
		}).done(function(response) {

				var data = $.parseJSON(response);

				$(data).each(function(i,val)
				 {
				    $.each(val,function(key,val)
				  	{
					     if(key=="name_char"){ document.getElementById("attr_name").value = val; }
					     if(key=="nature"){ document.getElementById("attr_Nature").value = val; }
					     if(key=="demeanor"){ document.getElementById("attr_Demeanor").value = val; }
					     if(key=="concept"){ document.getElementById("attr_Concept").value = val; }
					     if(key=="clan"){ document.getElementById("attr_Clan").value = val; }
					     if(key=="generation"){ document.getElementById("attr_Generation").value = val; }
					     if(key=="sire"){ document.getElementById("attr_Sire").value = val; }
					     if(key=="humanity_path"){ document.getElementById("attr_Path1Name").value = val; }
					     if(key=="humanity_total"){ document.vampire.attr_Path1.value=val; }
					     if(key=="willpower_total"){ document.vampire.attr_Willpower.value=val; }
					     if(key=="willpower_subtotal"){ document.getElementById("checkbox_Willpower"+val).checked = true;}

					     /*{	console.log(val);			          		
					        //window.location.replace("vampire/index.html?id="+val);  		
					     }/*else{//ERROR
					     	alert("No se pudo crear el vampiro intente nuevamente.");
					     }*/    
				  	});
				});
			
			}).fail(function(jqXHR) {
			  console.log(jqXHR.statusText);
		});
      ///////////////////end get basics
      });//end Ready
 });