<?php
require_once 'check_login.php';
if(isset($_POST['termini'], $_POST['mesec'], $_POST['leto'])){
	$termini = $_POST['termini'];
	$mesec = $_POST['mesec'];
	$leto =  $_POST['leto'];
	
	$sql = "INSERT INTO okulisticni (termin, datum, mesec, leto) VALUES('$termini', CURDATE(), '$mesec', '$leto')";
	require_once 'ainit.php';
	
	if($connection->query($sql)){
		echo "Termin uspešno dodan!";
	}else{
		echo "Nekaj se je zalomilo!";
	}
	mysqli_close($connection);
	exit();
	
}else{
	echo "Izpolnite vsa polja!";
}
?>