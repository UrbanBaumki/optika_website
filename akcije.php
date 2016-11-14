<?php 
include_once 'incl/init.php'; 


include_once 'incl/head.php'; ?>
<?php $aa = "active"; ?>

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
                 <text class="cText">AKCIJE</text>
             </div>
             <div class="cRibbon_lower_rib">
             </div>
            
             <!-- right side content -->
             <div id="rightContent">
             	<?php 
				$rezultat = $db->query("SELECT * FROM akcije ORDER BY id DESC");
				if(mysqli_num_rows($rezultat) < 1){
					echo "<h3>Trenutno ni vnešenih akcij</h3>";
				}
				while($row = mysqli_fetch_assoc($rezultat)):
				?>
             <h3><?= $row['naziv'];?></h3>
             <div><?= $row['opis'];?></div>
             <?php 
			 	$slika = $row['slika'];
				if($slika != ""){
					echo '<img src="'.$slika.'" width="40%" />';
				}				
				
			 ?>
              <div style="clear:both;"></div>
             <?php endwhile; ?>
            
             </div>
             
			
             <script>s_elem = document.getElementById("slide"); show(); </script>
             
             <!-- end of right side content -->
             
        </div>
    </div>
    <!-- end of content-->
<?php include_once 'incl/foot.php'; ?>