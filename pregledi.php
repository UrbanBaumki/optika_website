<?php 
include_once 'incl/init.php'; 
include_once 'incl/head.php'; ?>
<?php $oka = "active"; ?>

    <!-- Content -->
    
    <div id="contentWrap"><?php include_once 'incl/akcije.php'; ?>
        <div id="cSplitterLeft">
            <?php include_once 'incl/navMenu.php';
					include_once 'incl/novice.php';
			 ?>
            
            
        </div>
        
        <div id="cSplitterRight">
             <div class="cRibbon">
                 <text class="cText">OKULISTIČNI PREGLEDI</text>
             </div>
             <div class="cRibbon_lower_rib">
             </div>
            
             <!-- right side content -->
             <div id="rightContent">
                 <div id="pregledi_info">
                 <?php $rezultat = mysqli_fetch_assoc($db->query("SELECT * FROM okulisticni ORDER BY id DESC LIMIT 1"));?>
                 <h4>Termini okulističnih pregledov za tekoči mesec (<?= $rezultat['mesec'].'-'.$rezultat['leto']?>):</h4><br>
                 	-
                	<?= str_replace(";", "<br>-",$rezultat['termin'])?><br>
                    Na pregled se lahko naročite na številki <b>07 620 81 89</b> ali <b>041 651 557</b>.
					
                 </div><br>
             V sodobno opremljeni okulistični ambulanti opravljamo v povezavi z Bolnišnico Brežice brezplačne 
            
            okulistične preglede za očala in preglede za kontaktne leče.<br>
            <img src="resources/ambulanta/DSCF1222.JPG" width="48%"/>
            <img src="resources/ambulanta/DSCF1226.JPG" width="48%" /><br>
            <h4>PREGLEDE IZVAJAMO:</h4>
            <h4 style="clear:none; float:left;">-S koncesijo</h4>&nbsp; za zavarovance z veljavno napotnico splošnega zdravnika in 
            
            zdravstveno izkaznico.<br>
            <h4>-Samoplačniško</h4><br>
            Čakalna doba je <b>do 14 dni</b>, prav tako nudimo <b>brezplačne</b> preglede za kontaktne leče ob nakupu le 
            
            teh.<br>
            
            Preglede izvaja specialist okulist, ki se 
            
            resnično potrudi za vsakega pacienta. Zavedamo se, da le vrhunsko izveden pregled zagotavlja 
            
            kvalitetno izmerjeno dioptrijo za očala ali kontaktne leče. Upravičeni ste do recepta za očala, ki 
            
            vam pripada na podlagi zdravstvenega zavarovanja. <br>
            <img src="resources/ambulanta/DSCF1220.JPG" width="31%"/><img src="resources/ambulanta/DSCF1219.JPG" width="55%" />
            
            
            
            
            
             </div>
             
             
             
             <!-- end of right side content -->
             
        </div>
    </div>
    <!-- end of content-->
<?php include_once 'incl/foot.php'; ?>