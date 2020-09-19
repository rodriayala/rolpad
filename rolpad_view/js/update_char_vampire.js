/////////////////////Fill Advantages
function fillDicipline(id,name) {
	$('#attr_DiciplineSearch').val("");
	$('#displayDicipline').hide();
	//attr_Dicipline3name
	$("#disciplines").append('<div class="form-group row">'
							  	+ '<h4 class="col-sm-3 col-md-4 col-form-label" data-i18n="'+name+'">'+name+':</h4>'
							  	+ 	'<div class="col-sm-8 col-md-8" style="margin-top: 9px;">'
							  	+		'<input type="radio" name="'+id.name+'" value="1"  onclick="update_dis('+id+',1)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="2"  onclick="update_dis('+id+',2)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="3"  onclick="update_dis('+id+',3)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="4"  onclick="update_dis('+id+',4)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="5"  onclick="update_dis('+id+',5)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="6"  onclick="update_dis('+id+',6)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="7"  onclick="update_dis('+id+',7)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="8"  onclick="update_dis('+id+',8)" />'
							  	+	'</div>'
							  	+ '</div>');

	var id_char = $("#id_char").val(); 
	$.ajax({
		type: "POST",
		url: subsite + "create_disciplines_vampire.php",
		data: "id_char="+id_char+"&idCreate="+id
	}).done(function(response) {

	}).fail(function(jqXHR) {
	  console.log(jqXHR.statusText);
	});
}

function fillBackgrounds(id,name) {
	$('#attr_BackgroundsSearch').val("");
	$('#displayBackgrounds').hide();
	//attr_Dicipline3name
	$("#backgrounds").append('<div class="form-group row">'
							  	+ '<h4 class="col-sm-3 col-md-4 col-form-label" data-i18n="'+name+'">'+name+':</h4>'
							  	+ 	'<div class="col-sm-8 col-md-8" style="margin-top: 9px;">'
							  	+		'<input type="radio" name="'+id.name+'" value="1"  onclick="update_dis('+id+',1)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="2"  onclick="update_dis('+id+',2)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="3"  onclick="update_dis('+id+',3)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="4"  onclick="update_dis('+id+',4)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="5"  onclick="update_dis('+id+',5)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="6"  onclick="update_dis('+id+',6)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="7"  onclick="update_dis('+id+',7)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="8"  onclick="update_dis('+id+',8)" />'
							  	+	'</div>'
							  	+ '</div>');

	var id_char = $("#id_char").val(); 
	$.ajax({
		type: "POST",
		url: subsite + "create_backgrounds_vampire.php",
		data: "id_char="+id_char+"&idCreate="+id
	}).done(function(response) {

	}).fail(function(jqXHR) {
	  console.log(jqXHR.statusText);
	});
}

function fillOthers(id,name) {
	$('#attr_OthersSearch').val("");
	$('#displayOthers').hide();
	//attr_Dicipline3name
	$("#others").append('<div class="form-group row">'
							  	+ '<h4 class="col-sm-3 col-md-4 col-form-label" data-i18n="'+name+'">'+name+':</h4>'
							  	+ 	'<div class="col-sm-8 col-md-8" style="margin-top: 9px;">'
							  	+		'<input type="radio" name="'+id.name+'" value="1"  onclick="update_co('+id+',1)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="2"  onclick="update_co('+id+',2)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="3"  onclick="update_co('+id+',3)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="4"  onclick="update_co('+id+',4)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="5"  onclick="update_co('+id+',5)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="6"  onclick="update_co('+id+',6)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="7"  onclick="update_co('+id+',7)" />'
							  	+		'<input type="radio" name="'+id.name+'" value="8"  onclick="update_co('+id+',8)" />'
							  	+	'</div>'
							  	+ '</div>');

	var id_char = $("#id_char").val(); 
	$.ajax({
		type: "POST",
		url: subsite + "create_others_vampire.php",
		data: "id_char="+id_char+"&idCreate="+id
	}).done(function(response) {

	}).fail(function(jqXHR) {
	  console.log(jqXHR.statusText);
	});
}
/////////////////////end Fill Advantages

/////////////////////update Advantages
function update_at_ab(type,idUpdate,newValue)
{
	//alert(idChar+"-"+type+"-"+id_update+"-"+newValue);
	$.ajax({
		type: "POST",
		url: subsite + "update_char_vampire.php",
		data: "type="+type+"&idUpdate="+idUpdate+"&newValue="+newValue
	}).done(function(response) {

	}).fail(function(jqXHR) {
	  console.log(jqXHR.statusText);
	});
}

function update_dis(idUpdate,newValue)
{
	//alert(idChar+"-"+type+"-"+id_update+"-"+newValue);
	var id_char = $("#id_char").val(); 
	$.ajax({
		type: "POST",
		url: subsite + "update_discipline_char_vampire.php",
		data: "id_char="+id_char+"&idUpdate="+idUpdate+"&newValue="+newValue
	}).done(function(response) {

	}).fail(function(jqXHR) {
	  console.log(jqXHR.statusText);
	});
}

function update_ba(idUpdate,newValue)
{
	//alert(idChar+"-"+type+"-"+id_update+"-"+newValue);
	var id_char = $("#id_char").val(); 
	$.ajax({
		type: "POST",
		url: subsite + "update_backgrounds_char_vampire.php",
		data: "id_char="+id_char+"&idUpdate="+idUpdate+"&newValue="+newValue
	}).done(function(response) {

	}).fail(function(jqXHR) {
	  console.log(jqXHR.statusText);
	});
}

function update_co(idUpdate,newValue)
{
	//alert(idChar+"-"+type+"-"+id_update+"-"+newValue);
	var id_char = $("#id_char").val(); 
	$.ajax({
		type: "POST",
		url: subsite + "update_others_char_vampire.php",
		data: "id_char="+id_char+"&idUpdate="+idUpdate+"&newValue="+newValue
	}).done(function(response) {

	}).fail(function(jqXHR) {
	  console.log(jqXHR.statusText);
	});
}
/////////////////////end update Advantages

$(function () {//Ready
	var typingTimer;                //timer identifier
	var doneTypingInterval = 1000;  //time in ms
	//var $input = "";

	$( "#attr_name" ).focus(function() { tiping("#attr_name"); });
	$( "#attr_player" ).focus(function() { tiping("#attr_player"); });
	$( "#attr_Chronicle" ).focus(function() { tiping("#attr_Chronicle"); });
	$( "#attr_Nature" ).focus(function() { tiping("#attr_Nature"); });
	$( "#attr_Demeanor" ).focus(function() { tiping("#attr_Demeanor"); });
	$( "#attr_Concept" ).focus(function() { tiping("#attr_Concept"); });
	$( "#attr_Clan" ).focus(function() { tiping("#attr_Clan"); });
	$( "#attr_Generation" ).focus(function() { tiping("#attr_Generation"); });
	$( "#attr_Sire" ).focus(function() { tiping("#attr_Sire"); });


	function tiping(htmlTag)
	{
		var $input = $(htmlTag);

		$input.on('keyup', function () {		//on keyup, start the countdown
		  clearTimeout(typingTimer);
		  typingTimer = setTimeout(doneTyping, doneTypingInterval);
		});

		$input.on('keydown', function () {		//on keydown, clear the countdown 
		  clearTimeout(typingTimer);
		});

		function doneTyping () {
			var id_char = $("#id_char").val(); 
			var newValue = $(htmlTag).val();  
		  //alert(htmlTag);
		    $.ajax({
					type: "POST",
					url: subsite + "update_char_head_vampire.php",
					data: "id_char="+ id_char + '&htmlTag=' + htmlTag + '&newValue=' + newValue
				}).done(function(response) {
		
				}).fail(function(jqXHR) {
				  console.log(jqXHR.statusText);
			});
		
		}//end doneTyping
	}

	//Search disciplines
	 $("#attr_DiciplineSearch").keyup(function() {
	       var search = $('#attr_DiciplineSearch').val();

	       if (search == "") {
	           $("#displayDicipline").html("");
	       }
	       else {   
	           $.ajax({
	               type: "POST",
	               url: subsite + "search_disciplines_vampire.php",
	               data: "search="+search,
	               success: function(html) {
	                   $("#displayDicipline").html(html).show();
	               }
	           });
	       }
	 });
	//End Search disciplines

	//Search Backgrounds
	 $("#attr_BackgroundsSearch").keyup(function() {
	       var search = $('#attr_BackgroundsSearch').val();

	       if (search == "") {
	           $("#displayBackgrounds").html("");
	       }
	       else {   
	           $.ajax({
	               type: "POST",
	               url: subsite + "search_backgrounds_vampire.php",
	               data: "search="+search,
	               success: function(html) {
	                   $("#displayBackgrounds").html(html).show();
	               }
	           });
	       }
	 });
	//End Search Backgrounds

	//Search Others
	 $("#attr_OthersSearch").keyup(function() {
	       var search = $('#attr_OthersSearch').val();

	       if (search == "") {
	           $("#displayOthers").html("");
	       }
	       else {   
	           $.ajax({
	               type: "POST",
	               url: subsite + "search_other_vampire.php",
	               data: "search="+search,
	               success: function(html) {
	                   $("#displayOthers").html(html).show();
	               }
	           });
	       }
	 });
	//End Search Others
 });//end Ready