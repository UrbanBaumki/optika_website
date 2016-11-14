<?php 

if(isset($_POST['tip'], $_POST['model'], $_POST['opis'], $_POST['barve'], $_POST['velikosti'])){
	$tabela = $_POST['tip'];
	$idOcal = $_POST['id'];
	$model = $_POST['model'];
	$opis = $_POST['opis'];
	$velikosti = $_POST['velikosti'];
	$barve = $_POST['barve'];

	require_once 'ainit.php';
	if(!$connection->query("UPDATE $tabela SET model = '$model', opis = '$opis', velikosti= '$velikosti', barve = '$barve' WHERE id = '$idOcal'")){
		echo "Nekaj se je zalomilo";
		exit;
	}
	
	if($_FILES['slika']['tmp_name'] != ""){
		$datIme = $_FILES['slika']['name'];
		$datTMPime = $_FILES['slika']['tmp_name'];
		
		$fileExt = end(explode(".", $datIme));
		
		$db_name = $idOcal . "." .$fileExt;
		
		if(!preg_match("/\.(gif|jpg|jpeg|png)$/i", $datIme)){
			echo "Nepravilen format";
			exit();
		}
		
		$potDatoteke = "../slike/".$tabela."/".$db_name;
		if(file_exists($potDatoteke)){
			unlink($potDatoteke);
		}
		$pravapot = "./slike/".$tabela."/".$db_name; //za v pb prava pot
		
		$moveResult = move_uploaded_file($datTMPime, $potDatoteke);
		if($moveResult != true){
			echo "Upload slike ni uspel";
			exit();
		}
		
		if($connection->query("UPDATE $tabela SET slika ='$pravapot' WHERE id = '$idOcal'")){
			echo 'Očala '.$model. ' uspešno spremenjena!';
		}else{
			echo 'Nekaj se je zalomilo :s';
		}
	
		mysqli_close($connection);
		exit();
		
	}//KONEC S SLIKO
	
	echo 'Očala '.$model. ' uspešno spremenjena!';
}
?>