<?php 

if(isset($_POST['delA'])){
	$id = $_POST['delA'];	
	$sqlDel = "DELETE FROM akcije WHERE id = '$id'";
	require_once 'ainit.php';
	$result = $connection->query("SELECT * FROM akcije WHERE id = '$id'");
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