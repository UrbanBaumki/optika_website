// JavaScript Document
$(document).ready(function() {
    
	var stuck = false;
	
	function scrollYOffset(){
		return window.pageYOffset;
	}
	
	$(document).on('scroll', function(){
		var yScroll = scrollYOffset();
		
		if(yScroll >= 200){
			if(!stuck){
				$("#head").css({"position" : "fixed", "top" : "0"});
				$("#pusher").css("height", "250");
				stuck = true;
			}
			
		}else if(yScroll < 200){
			if(stuck){
				$("#head").css("position", "relative");
				$("#pusher").css("height", "200");
				stuck = false;
			}
			
		}
	});
	
	
});