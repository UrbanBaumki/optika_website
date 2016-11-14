<?php 
		$rezultat = $db->query("SELECT * FROM akcije_slika ORDER BY id DESC LIMIT 1");
		$row = mysqli_fetch_assoc($rezultat);
		$stVrstic = mysqli_num_rows($rezultat);
		$out = "";
		if($stVrstic == 1 && $row['prikaz'] == 1){
			$out = '<div id="akcija_showcase"><img src="'.$row['slika'].'" /></div>';
		}
		echo $out;
		?>