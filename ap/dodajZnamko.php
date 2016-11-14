<?php 
if(isset($_POST['vrsta'], $_POST['znamka']) && $_POST['znamka'] != ""){
	$znamka = $_POST['znamka'];
	$vrsta = $_POST['vrsta'];
	$vrstaID;
	if($vrsta == "korekcijska"){
		$vrstaID = 1;
	}else if($vrsta == "soncna"){
		$vrstaID = 0;
	}else{
		echo 'Napačen vnos';
		exit();	
	}
	include_once 'ainit.php';
	
	$sql = "INSERT INTO znamke (znamka, korekcijska) VALUES ('$znamka', '$vrstaID')";
	if($connection->query($sql)){
		echo 'Znamka '.$znamka.' uspešno dodana v '.$vrsta.'!';
		exit();
	}else{
		echo 'Neuspešno dodano..';
	}
}else{
	echo 'Vsa polja niso izpolnjena!';
}

 ?>