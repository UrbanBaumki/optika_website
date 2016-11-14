<?php 
if(isset($_POST['akcija'], $_POST['opis'], $_FILES['slika']['name']) && $_POST['akcija']!= "" &&  $_POST['opis']!= "" ){
	$naziv = $_POST['akcija'];
	$opis= $_POST['opis'];
	
	require_once 'ainit.php';
	
	if($connection->query("INSERT INTO akcije(naziv, opis) VALUES('$naziv', '$opis')")){
		
		
			//datoteke(slika):
		if($_FILES['slika']['tmp_name'] != ""){
			$datIme = $_FILES['slika']['name'];
			$datTMPime = $_FILES['slika']['tmp_name'];
			$fileType = $_FILES['slika']['type'];
			$fileSize = $_FILES['slika']['size'];
			$fileErrMsg = $_FILES['slika']['error'];
		
			$fileExt = end(explode(".", $datIme));
			list($width, $height) = getimagesize($datTMPime);
			
			$query = $connection->query("SELECT MAX(id) AS id FROM akcije");
			$row = mysqli_fetch_assoc($query);
			$id = $row['id'];
			//za sliko
		
			$db_name = $id . "." .$fileExt;
			if(!preg_match("/\.(gif|jpg|jpeg|png)$/i", $datIme)){
				echo "Nepravilen format";
				exit();
			}
			
			
			$potDatoteke = "../slike/akcijeOpis/".$db_name; //relativna pot iz trenutne mape do slike -> za prenos
			
			$pravapot = "./slike/akcijeOpis/".$db_name; //za v pb prava pot
				
				
			$moveResult = move_uploaded_file($datTMPime, $potDatoteke);
			if($moveResult != true){
				echo "Upload slike ni uspel";
				exit();
			}
			
			if($connection->query("UPDATE akcije SET slika ='$pravapot' WHERE id = '$id'")){
				echo 'Akcija uspešno dodana!';
			}else{
				echo 'Nekaj se je zalomilo :s';
			}
			
		}else{
			echo 'Akcija uspešno dodana!';
		}
		
		
	}else{
		echo "Neuspelo";	
	}
	mysqli_close($connection);
	exit();
}else{
	echo "Izpolni vsa polja";
}
?>