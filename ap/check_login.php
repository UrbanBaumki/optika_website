<?php 
session_start();
if(!isset($_SESSION['oamanager'])){
	header('Location: ./li.php');
	exit();
}
//Preverimo če je SESSION v pb
	$mID = preg_replace("#[^0-9]#i", "", $_SESSION["id"]);
	$manager = preg_replace("#[^A-Za-z0-9]#i", "", $_SESSION["oamanager"]);
	$pass = preg_replace("#[^A-Za-z0-9]#i", "", $_SESSION["password"]);
	
	include '../incl/init.php';
	$sql = "SELECT * FROM uporabniki WHERE id='$mID' AND ime='$manager' AND geslo='$pass' LIMIT 1";
	
	$query = $db->query($sql);
	$koliko = mysqli_num_rows($query);
	if($koliko == 0){
		header("Location: ../index.php"); //nazaj na splošno stran
		exit();
	}  
?>