<?php
$lClas="";
$oClas="";
$da ="";
$oa="";
$ka="";
$koa="";
$aa="";
$oka = "";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Optika AS</title>
<link rel="stylesheet" type="text/css" href="stil/stil.css"/>
<link rel="shortcut icon" href="../resources/ico.png">
</head>

<body>

    <div id="headWrap">
       <div id="hSplitterLeft">
           <a class="logoL" href="/" title="Optika As"></a>
       </div>
       
       <div id="hSplitterRight">
           <a href="https://www.facebook.com/optika.as.7" title="facebook povezava"><img class="linkImgs" src="resources/fb_logo.png" /></a>
           <a target="_top" href="mailto:optika.as.sevnica@gmail.com" title="e-pošta: optika.as.sevnica@gmail.com"><img class="linkImgs linkMail" src=					"resources/mail_logo.png"  /></a>
       </div>
    </div>
    <!-- end of Header -->
    
    
    <div id="searchRib">
        <input style="color:#00adef; font-weight:bold;" name="searchBox" id="searchBox" type="text" placeholder="Iskanje..."  size="22" onkeydown="isci()"/>
        <div id="searchD">
    	</div>
    </div>
    
    
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
		var sShowing = 0;
			function isci(){
				var sText = $("#searchBox").val();
				if(sText == ""){
					$("#searchD").html("");
					if(sShowing == 1){
						$("#searchD").toggle(400);
						sShowing = 0;
					}
					return;	
				}
				if(sShowing == 0){
					$("#searchD").toggle(400);
					sShowing = 1;
				}
				$.post("incl/search.php", { isci: sText}, function(response){
					$("#searchD").html(response);
					});
			}

	</script>
    