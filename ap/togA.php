<?php 

if(isset($_POST['en'] )){
	$id = $_POST['en'];
	
	require_once 'ainit.php';
	
	
	if($connection->query("UPDATE akcije_slika SET prikaz = 1 WHERE id = '$id'")){
		
		echo "Uspešno";
		exit();
	}else{
		echo "Nekaj se je zalomilo";
		exit();
	}
}
if(isset($_POST['dis'] )){
	$id = $_POST['dis'];
	
	require_once 'ainit.php';
	
	
	if($connection->query("UPDATE akcije_slika SET prikaz = 0 WHERE id = '$id'")){
		
		echo "Uspešno";
		exit();
	}else{
		echo "Nekaj se je zalomilo";
		exit();
	}
}
?>