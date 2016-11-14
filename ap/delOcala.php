<?php 

if(isset($_POST['ocala']) && isset($_POST['type'])){
	$id = $_POST['ocala'];
	$tip = $_POST['type'];
	$tabela = "";
	if($tip == 0){
		$tabela = "soncna";
	}else if ($tip == 1){
		$tabela = "korekcijska";
	}
	$sqlDel = "DELETE FROM $tabela WHERE id = '$id'";
	require_once 'ainit.php';
	$result = $connection->query("SELECT * FROM $tabela WHERE id = '$id'");
	$row = mysqli_fetch_assoc($result);
	$link = ".".$row['slika'];
	if($connection->query($sqlDel)){
		if(file_exists($link) && $link != "."){
			unlink($link);
		}
		echo "Izbrisano";
		exit();
	}else{
		echo "Nekaj se je zalomilo";
		exit();
	}
}
?>