<div id="left_news">
            	<div class="cRibbon nRibbon">
                    <text>NOVICE</text>                    
                </div>
                <div class="cRibbon_lower_rib">
                </div>
                <?php 
				$sql = "SELECT * FROM novice ORDER BY datum DESC, cas DESC LIMIT 6";
				$nQuery = $db->query($sql); ?>
                <?php while($arry = mysqli_fetch_assoc($nQuery)) : ?>
                <div class="novica"><p style="margin-left:4px;"><?php echo $arry['novica'];?><br><p style="margin-left:10px; font-size: 10px;"><?php echo $arry['uporabnik']."-". date("d-m-Y", strtotime($arry['datum'])); ?></p></p></div>
                <?php endwhile; ?>
            </div>