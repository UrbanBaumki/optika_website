<?php
if(isset($_POST['isci'])){
	if($_POST['isci'] != ""){
		$kljucna = preg_replace("#[^0-9a-z_\s]#i","",$_POST['isci']);
		$out = "";
		require_once 'init.php';
		//SONČNA OČALA
		$rezultat = $db->query("SELECT * FROM soncna JOIN znamke USING (zid) WHERE CONCAT(znamka, ' ' , model) LIKE '%$kljucna%'");
		if(mysqli_num_rows($rezultat) > 0){
			$out.= "<h5>Sončna očala:</h5>";
			while($row = mysqli_fetch_assoc($rezultat)){
			$out.= "<h4 style='margin-left: 15px;'>&bull;  <a style='color:black;' href='izdelek.php?o=".$row['id']."'>" .$row['znamka']. " " . $row['model']. "</a></h4>&nbsp;&nbsp;&nbsp;&nbsp;".$row['opis']."<br><br>";
			}
		}else{
			$out.= "<h3>Sončna očala:</h3>Ni rezultatov iskanja..<br><br>";
		}
		
		//KOREKCIJSKA OČALA
		$rezz = $db->query("SELECT * FROM korekcijska JOIN znamke USING (zid) WHERE CONCAT(znamka, ' ' , model) LIKE '%$kljucna%'");
		if(mysqli_num_rows($rezz) > 0){
			$out.="<h5>Korekcijska očala:</h5>";
			while($row = mysqli_fetch_assoc($rezz)){
			$out.= "<h4 style='margin-left: 15px;'>&bull;  <a style='color:black;' href='izdelek.php?k=".$row['id']."'>" .$row['znamka']. " " . $row['model']. "</a></h4>&nbsp;&nbsp;&nbsp;&nbsp;".$row['opis']."<br><br>";
			}
			;
		}else{
			$out.= "<h3>Korekcijska očala:</h3>Ni rezultatov iskanja..";
		}
		echo $out;
		
		
	}
	

	
}
exit();	
?>