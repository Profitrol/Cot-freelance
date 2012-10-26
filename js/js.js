
function select_region(field){

	$.get('location.php', { countryid: $("#country" + field + " option:selected").val(), field: field },
		function(data){
			$("#region" + field).hide().html(''+data+'').fadeIn();
			$("#city" + field).hide();
		});
}

function select_city(field){

	$.get('location.php', { regionid: $("#region" + field + " option:selected").val(), field: field },
		function(data){
			$("#city" + field).hide().html(''+data+'').fadeIn();
		});
}

$(document).ready(function(){
	$('#formtext').maxlength({   
		events: [], // Array of events to be triggerd    
		maxCharacters: 1000, // Characters limit   
		status: true, // True to show status indicator bewlow the element    
		statusClass: "status", // The class on the status div  
		statusText: "символов осталось", // The status text  
		notificationClass: "notification",	// Will be added when maxlength is reached  
		showAlert: false, // True to show a regular alert message    
		alertText: "You have typed too many characters.", // Text in alert message   
		slider: false // True Use counter slider    
		}); 
});

function hidtopinfo(){
	$("#topinfo").hide();
	$.cookie("hidtopinfo", 1);
}

function OpenContactform(touserid){

	$.get('plug.php?o=contactform', { touserid: touserid },
		function(data){
			$("#contactform").hide().html(''+data+'').fadeIn();
		});
}

function CloseContactform(){
	$("#contactform").hide();
};
