<?php
require_once 'incl/init.php';
?>
<?php include_once 'incl/head.php'; 
 //these are for activating /SHOWING the submenu, if class is on, then submenu shows, else it does not.
 $oa = "active";
 $oClas ="on";
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
                 <text class="cText">KOREKCIJSKA OČALA</text>
             </div>
             <div class="cRibbon_lower_rib">
             </div>
            
             <!-- right side content -->
             <div id="rightContent">
             <div class="filter_holder">
             		<h3>Filtriraj po znamki:</h3>
                    <form id="filterGroupForm" method="post" onSubmit="return false;" >
                    <input type="hidden" name="tip" value="korekcijska" />
                     <?php 
                        $rezultat = $db->query("SELECT DISTINCT zid, znamka FROM znamke JOIN korekcijska USING(zid)");
                        while($vrstica = mysqli_fetch_assoc($rezultat)):
                    ?>
                    <div class="check_box_wrap"><input class="filterCheck" id="<?=$vrstica['zid']?>" type="checkbox" name="znamkeFilter[]" value="<?=$vrstica['zid']?>" onChange="objavi()" /><label class="filter" for="<?=$vrstica['zid']?>"> <?= $vrstica['znamka']?></label></div>
                    <?php endwhile; ?>
                    
                 </form>
             	</div>
             
             	<div id="poravnava">
                <?php $rezultat = $db->query("SELECT * FROM korekcijska JOIN znamke USING(zid) ORDER BY id DESC");  ?>
                <?php while($vrstica = mysqli_fetch_assoc($rezultat)) : ?>
            	<div class="product">
                	<a href="izdelek.php?k=<?= $vrstica['id'];?>">
                	<img src="<?= $vrstica['slika'];?>" />
                	<div class="productRibon">
                    	<p><?= $vrstica['znamka'];?></p>
                        <p><?= $vrstica['model'];?></p>
                    </div>
                    </a>
                </div>
                <?php endwhile; ?>
                
                </div>
             </div>
             
<script type="text/javascript" src="js/filter.js"></script>                        
             <!-- end of right side content -->
             
        </div>
    </div>
    <!-- end of content-->
 <?php include_once 'incl/foot.php'; ?>