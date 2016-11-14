<?php
require_once 'incl/init.php';
?>
<?php include_once 'incl/head.php'; 
 //these are for activating /SHOWING the submenu, if class is on, then submenu shows, else it does not.
 $oa = "active";
 $oClas ="on";
?>

<?php

if(isset($_GET['o']))
{
	$id = preg_replace("#[^0-9]#i","", $_GET['o']);	
	$tabela = "soncna";
	$Pripis = "OČALA ";
	
}else if(isset($_GET['k'])){
		$id = preg_replace("#[^0-9]#i","", $_GET['k']);	
		$tabela = "korekcijska";
		$Pripis = "OČALA ";

}else{
	
	header("Location: /");	
}
?> 
    <!-- Content -->
    
    <div id="contentWrap">
    
    <?php include_once 'incl/akcije.php'; ?>
        <div id="cSplitterLeft">
               <?php include_once 'incl/navMenu.php';
					include_once 'incl/novice.php';
			 ?>
        </div>
        
        <div id="cSplitterRight" >
        <?php $rezultat = $db->query("SELECT * FROM $tabela JOIN znamke USING(zid) WHERE id ='$id'"); 
					$vrstica = mysqli_fetch_assoc($rezultat);
				?>
             <div class="cRibbon">
                 <text class="cText"><?= $Pripis.' '. $vrstica['znamka'].' '.$vrstica['model'] ?></text>
             </div>
             <div class="cRibbon_lower_rib">
             </div>
            
             <!-- right side content -->
             <div id="rightContent" >
             	<div id="poravnava" >
                
                	<img style="border:2px solid black; display:block; float:left;" src="<?= '.'.$vrstica['slika'] ?>" width="40%" height="35%" />
                	<div id="izdelekInfo" style="float:right; overflow:hidden; min-height:300px; width:350px;">
                    	
                        <h5><?=$vrstica['znamka'].' '.$vrstica['model'] ?></h5>
                        
                        <div class="iHolder">
                        	<p style="border:none;"><?= $vrstica['opis']?></p>
                        </div><br>
                        <h5>Lastnosti izdelka</h5>
                        <div class="iHolder">
                        	<p>Proizvajalec: <?= $vrstica['znamka']?></p>
                            <p>Model: <?= $vrstica['model']?></p>
                            <p>Velikosti: <?= $vrstica['velikosti']?></p>
                            <p>Barve: <?= $vrstica['barve']?></p>
                        </div>
                    </div>
                    
                </div>
                <a style="position:absolute; bottom: 0; float:left; text-decoration:none;" href="javascript:history.back()"><input class="backB" type="submit" value="Nazaj"></a>
             </div>
             
                       
             <!-- end of right side content -->
             
        </div>
    </div>
    <!-- end of content-->
 <?php include_once 'incl/foot.php'; ?>