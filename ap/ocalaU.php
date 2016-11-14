<?php
require 'check_login.php';
?>
<?php

if(isset($_FILES['ocala']['name'], $_POST['znamka'], $_POST['model'], $_POST['opis'], $_POST['velikosti'], $_POST['barve']) && $_FILES['ocala']['tmp_name'] != ""){
	
	
	//vrednosti
	
	$IDznamka = $_POST['znamka'];
	$model = $_POST['model'];
	$opis = $_POST['opis'];
	$velikosti = $_POST['velikosti'];
	$barve = $_POST['barve'];
	//preveri ali id znamke pripada korekcijskim ali sončnim očalm
	require_once '../incl/init.php';
	$result = $db->query("SELECT * FROM znamke WHERE zid = '$IDznamka'");
	$row = mysqli_fetch_assoc($result);
	$korekcijska = $row['korekcijska'];
	$tabela = "";
	if($korekcijska == 1){
		$tabela = "korekcijska";
	}else if($korekcijska == 0){
		$tabela = "soncna";
	}
	//datoteke(slika):
	$datIme = $_FILES['ocala']['name'];
	$datTMPime = $_FILES['ocala']['tmp_name'];
	$fileType = $_FILES['ocala']['type'];
	$fileSize = $_FILES['ocala']['size'];
	$fileErrMsg = $_FILES['ocala']['error'];
	
	$fileExt = end(explode(".", $datIme));
	list($width, $height) = getimagesize($datTMPime);
	//ime v podatkovni bazi --> reflektira id modela	
	mysqli_close($db);
	
	//vključimo admin povezavo
	require_once 'ainit.php';
		
	//Vstavimo očala v temu primerno tabelo:
	
	$sqlInser = "INSERT INTO $tabela (zid, model, opis,velikosti, barve) VALUES ('$IDznamka','$model','$opis', '$velikosti', '$barve')";
	
	if(!$connection->query($sqlInser)){
		mysqli_close($connection);
		echo 'Nekaj se je zalomilo';
		exit();
	}
	
	$query = $connection->query("SELECT MAX(id) AS id FROM $tabela");
	$row = mysqli_fetch_assoc($query);
	$id = $row['id'];
	//za sliko
	
	$db_name = $id . "." .$fileExt;
	if(!preg_match("/\.(gif|jpg|jpeg|png)$/i", $datIme)){
		echo "Nepravilen format";
		exit();
	}
	
	//odstranitev slike unlink($picurl);
	
	
	$potDatoteke = "../slike/".$tabela."/".$db_name; //relativna pot iz trenutne mape do slike -> za prenos
	
	$pravapot = "./slike/".$tabela."/".$db_name; //za v pb prava pot
	
	
	$moveResult = move_uploaded_file($datTMPime, $potDatoteke);
	if($moveResult != true){
		echo "Upload slike ni uspel";
		exit();
	}
	
	if($connection->query("UPDATE $tabela SET slika ='$pravapot' WHERE id = '$id'")){
		echo 'Očala '.$model. ' uspešno dodana v rubriko '. $tabela.' očala!';
	}else{
		echo 'Nekaj se je zalomilo :s';
	}
	
	mysqli_close($connection);
	exit();
	//zmanjšaš sliko
	//include_once 'resize.php';
	
}else{
	echo "Izpolnite vsa polja!";
	exit();
}

?>