<?php
require_once 'incl/init.php';
?>
<?php include_once 'incl/head.php'; 
 //these are for activating /SHOWING the submenu, if class is on, then submenu shows, else it does not.
 $ka = "active";
 $lClas ="on";
?>

    
    <!-- Content -->
    
    <div id="contentWrap"><?php include_once 'incl/akcije.php'; ?>
        <div id="cSplitterLeft">
               <?php include_once 'incl/navMenu.php';
					include_once 'incl/novice.php';
			 ?>
        </div>
        
        <div id="cSplitterRight">
             <div class="cRibbon">
                 <text class="cText">KONTAKTNE LEČE</text>
             </div>
             <div class="cRibbon_lower_rib">
             </div>
            
             <!-- right side content -->
             <div id="rightContent">
             	
                <a href="#" onClick="displayType(1)" class="buketLink" ><div class="bukket">
                	<img src="slike/lece/leče dnevne1.jpg"/>
                    <div class="bukketRibon">
                    	<div class="ribonTextHolder">
                        DNEVNE LEČE
                        </div>
                    </div>
                </div></a>
                
                <a href="#" onClick="displayType(2)" class="buketLink">
                <div class="bukket">
                	<img   src="slike/lece/14dnevne leče1.jpg"/>
                    <div class="bukketRibon">
                    	<div class="ribonTextHolder">
                        14-DNEVNE LEČE
                        </div>
                    </div>
                </div></a>
                
                <a href="#" onClick="displayType(3)" class="buketLink"><div class="bukket">
                	<img   src="slike/lece/leče1.jpg"/>
                    <div class="bukketRibon">
                    	<div class="ribonTextHolder">
                        MESEČNE LEČE
                        </div>
                    </div>
                </div></a>
               
                
             </div>
             
<script type="text/javascript">
	$("input.btn").click(function(e){
		e.preventDefault();	
	});
	
	$("a.buketLink").click(function(e){
		e.preventDefault();	
	});
	function displayType(vrsta){
		
		var vr = vrsta;
		if (vr == 1){
			$("#rightContent").load('dnevne.html');
		}else if (vr == 0){
			$("#rightContent").load('lPicker.html');
		}
		else if (vr == 2){
			$("#rightContent").load('14dnevne.html');
		}
		else if (vr == 3){
			$("#rightContent").load('mesecne.html');
		}
		
	}
</script>       
             <!-- end of right side content -->
             
        </div>
    </div>
    <!-- end of content-->
 <?php include_once 'incl/foot.php'; ?>