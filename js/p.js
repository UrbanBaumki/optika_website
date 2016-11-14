// JavaScript Document
$(document).ready(function() {
    
	var el = [$("#oW"), $("#okW"), $("#nW"), $("#aW")];
	
	function closeAll(){
		for(var i = 0; i < el.length; i++){
			el[i].hide(0);
		}
	}
	
	
	$("#ocala").click(function(){
		closeAll();
		el[0].show(200).delay(200);
	});
	$("#okul").click(function(){
		closeAll();
		el[1].show(200).delay(200);
	});
	$("#novice").click(function(){
		closeAll();
	
		el[2].show(200).delay(200);
	});
	$("#akcije").click(function(){
		closeAll();
		el[3].show(200).delay(200);
	});
});