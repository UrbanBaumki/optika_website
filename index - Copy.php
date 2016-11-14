<?php 
include_once 'incl/init.php'; 


include_once 'incl/head.php'; ?>
<?php $da = "active"; ?>
<?php
$output="";
$result = $db->query("SELECT * FROM slide");
while($rrow = mysqli_fetch_assoc($result)){
	$output.= '"<img src=\''.$rrow['link'].'\' width=\'100%\' />",';
}


?>
<script type="text/javascript">
var p_elem = [<?php echo $output ?>];
var p_i = 0;
var s_elem;

function nextSlide(){
	
	p_i++;
	s_elem.style.opacity = 0;
	if(p_i >= p_elem.length){
		p_i = 0;
	}
	setTimeout('show()',1000);
}
function show(){
	s_elem.innerHTML = p_elem[p_i];
	s_elem.style.opacity = 1;
	setTimeout('nextSlide()',4000);
}
</script>
    <!-- Content -->
    
    <div id="contentWrap">
    	<?php include_once 'incl/akcije.php'; ?>
    	
        <div id="cSplitterLeft">
            <?php include_once 'incl/navMenu.php';
					include_once 'incl/novice.php';
			 ?>
            
            
        </div>
        
        <div id="cSplitterRight">
             <div class="cRibbon">
                 <text class="cText">DOMOV</text>
             </div>
             <div class="cRibbon_lower_rib">
             </div>
            
             <!-- right side content -->
             <div id="rightContent">
             	<span style="color:#2e3192;"><b>Optika</b></span> <span  style="color:#00adef;"><b>AS</b></span> je optika s posluhom, saj si za svoje stranke vedno vzamemo čas in jim prisluhnemo. 

Izbirate lahko med široko ponudbo korekcijskih in sončnih očal, katerih izbor moških, ženskih in 

otroških po zadnjih modnih smernicah je pester.<br><br>
             	<div id="slide" style="transition: opacity 1.0s linear;overflow:hidden; position:relative; height: 320px;"></div><br>
                
                Vsi tisti, ki prisegate na kontaktne leče, lahko 

izbirate med kontaktnimi lečami in tekočinami različnih vrst ter ostalega potrebnega pribora. 

Prodajni program nenehno osvežujemo in dopolnjujemo, kljub temu pa vedno ostaja cenovno 

ugoden.<br><br>Ponudba okvirjev in kontaktnih leč in tekočin je pestra, nudimo korekcijska stekla vodilnih svetovnih 

proizvajalcev, kot so <strong>Carl Zeiss, Essilor, Hoya, Alcom</strong> in druge po ugodnih cenah. Prav tako je precej 

bogata in atraktivna tudi izbira sončnih očal znanih proizvajalcev <strong>Ray Ban, Giorgio Armani, Police, 

Dolce & Gabbana, Carrera</strong> in še mnoge druge.<br><br>
V naši optiki opravljamo tudi <strong>okulistične preglede</strong>, kjer v sodobno opremljeni okulistični ambulanti v 

povezavi z Bolnišnico Brežice naši strokovnjaki opravljajo brezplačne okulistične preglede za očala 

in kontaktne leče. </div>
             
			
             <script>s_elem = document.getElementById("slide"); show(); </script>
             
             <!-- end of right side content -->
             
        </div>
    </div>
    <!-- end of content-->
<?php include_once 'incl/foot.php'; ?>