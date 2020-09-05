
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

$(function () {//Ready
//setup before functions
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

		function doneTyping () {		//user is "finished typing," do something
		  //do something
		  alert(htmlTag);
		}
	}

 });//end Ready