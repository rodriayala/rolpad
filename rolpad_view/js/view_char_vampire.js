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
				//console.log(data);
				$(data).each(function(i,res)
				 {
				    $.each(res,function(key,val)
				  	{
				  		$.each(val,function(key2,val2)
					  	{
					  		$.each(val2,function(key3,val3)
					  		{
								$.each(val3,function(key4,val4)
					  			{					  			
									$.each(val4,function(key5,val5)
					  				{

										if(key5=="name_char"){ document.getElementById("attr_name").value = val5; }
									    if(key5=="nature"){ document.getElementById("attr_Nature").value = val5; }
									    if(key5=="demeanor"){ document.getElementById("attr_Demeanor").value = val5; }
									    if(key5=="concept"){ document.getElementById("attr_Concept").value = val5; }
									    if(key5=="clan"){ document.getElementById("attr_Clan").value = val5; }
									    if(key5=="generation"){ document.getElementById("attr_Generation").value = val5; }
									    if(key5=="sire"){ document.getElementById("attr_Sire").value = val5; }
									    if(key5=="humanity_path"){ document.getElementById("attr_Path1Name").value = val5; }
									    if(key5=="humanity_total"){ document.vampire.attr_Path1.value=val5; }
									    if(key5=="willpower_total"){ document.vampire.attr_Willpower.value=val5; }
									    if(key5=="willpower_subtotal"){ document.getElementById("checkbox_Willpower"+val5).checked = true;}
									    if(key5=="bloodpool_total"){ document.getElementById("attr_BloodPool"+val5).checked = true;}	
				 						if(key5=="experience"){ document.getElementById("experience").value = val5; }
				 						///if(key5=="is_npc"){ document.getElementById("is_npc").value = val5; }
						 												  			
					  				});	//End val5
										//attributes
								  		let col = 0;
								  		if(key4=="attributes"){ col = 1; }
								  		if(key4=="abilities"){ col = 2; }	
								  		console.log(val4.name);
								  			$("#col"+col+val4.column_al+"").append('<div class="form-group row">'
								  								+ '<h4 class="col-sm-3 col-md-4 col-form-label" data-i18n="'+val4.name+'">'+val4.name+':</h4>'
								  								+ 	'<div class="col-sm-8 col-md-8" style="margin-top: 9px;">'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="1" '+ (val4.actual_value == 1 ? "checked": " ") +' />'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="2" '+ (val4.actual_value == 2 ? "checked": " ") +' />'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="3" '+ (val4.actual_value == 3 ? "checked": " ") +' />'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="4" '+ (val4.actual_value == 4 ? "checked": " ") +' />'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="5" '+ (val4.actual_value == 5 ? "checked": " ") +' />'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="6" '+ (val4.actual_value == 6 ? "checked": " ") +' />'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="7" '+ (val4.actual_value == 7 ? "checked": " ") +' />'
								  								+		'<input type="radio" name="'+val4.html_tag+'" value="8" '+ (val4.actual_value == 8 ? "checked": " ") +' />'
								  								+	'</div>'
								  								+ '</div>');
								  		//end attributes				  												
					  			});	
							});
						});
				  	});
				 }); 		
		
			
			}).fail(function(jqXHR) {
			  console.log(jqXHR.statusText);
		});
      ///////////////////end get basics
      });//end Ready
 });