// JavaScript Document
//Written by Urban Baumkirher
$(document).ready(function() {
    
	//klik na link toggle podmeni
	$("a#ocala").click( function(e) {
		e.preventDefault();
		$("ul.ocalaMenu").toggle(500);
	});
	
	$("a#lece").click( function(e) {
		e.preventDefault();
		$("ul.leceMenu").toggle(500);
	});
});