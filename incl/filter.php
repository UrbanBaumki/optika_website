<?php
include_once 'init.php';
if(isset($_POST['znamkeFilter'], $_POST['tip'])){
	//Filtriramo želje
	$tabela = preg_replace("#[^a-z]#i", "", $_POST['tip']);
	$tipParsa = "";
	if($tabela == "soncna"){
		$tipParsa = "o";
	}else{
		$tipParsa = "k";
	}
	$izbire = preg_replace("#[^0-9]#", "", $_POST['znamkeFilter']);
	$izbirice = "";
	for($i = 0; $i < count($izbire); $i++){
		if($i == 0){
			$izbirice.= 'zid='.$izbire[$i];
		}else{
			$izbirice.= ' OR zid='. $izbire[$i];
		}
	}
	$sql = "SELECT * FROM $tabela JOIN znamke USING(zid) WHERE $izbirice ORDER BY id DESC";
	$out = "";
	
	$rez = $db->query($sql);
	
	while($vrstica = mysqli_fetch_assoc($rez)) {
			
			$out.= '<div class="product"><a href="izdelek.php?'.$tipParsa.'='.$vrstica['id'].'"><img src="'.$vrstica['slika'].'" /><div class="productRibon"><p>'.$vrstica['znamka'].'</p><p>'.$vrstica['model'].'</p></div></a></div>';
		
	}
	
	echo $out;
	
}else if(isset($_POST['tip'])){
	$tabela = $_POST['tip'];
	$sql = "SELECT * FROM $tabela JOIN znamke USING(zid) ORDER BY id DESC";
	
	$tipParsa = "";
	if($tabela == "soncna"){
		$tipParsa = "o";
	}else{
		$tipParsa = "k";
	}
	
	$rez = $db->query($sql);
	$out="";
	while($vrstica = mysqli_fetch_assoc($rez)) {
			
			$out.= '<div class="product"><a href="izdelek.php?'.$tipParsa.'='.$vrstica['id'].'"><img src="'.$vrstica['slika'].'" /><div class="productRibon"><p>'.$vrstica['znamka'].'</p><p>'.$vrstica['model'].'</p></div></a></div>';
		
	}
	
	echo $out;
}
?>