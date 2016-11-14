<?php 
if(isset($_POST['znamke'])){
	$katera = $_POST['znamke'];
	$slq = "";
	if($katera == 1){
		$sql = "SELECT * FROM znamke WHERE korekcijska = 1";
	}else if($katera == 0){
		$sql = "SELECT * FROM znamke WHERE korekcijska = 0";
	}
	
	require_once 'ainit.php';
	$q = $connection->query($sql);
	$output ="";
	while($row = mysqli_fetch_assoc($q)){
		
				$zid = $row['zid'];
				$znamka = $row['znamka'];
               $output.=     	'<option value="'.$zid.'" >'.$znamka.'</option>';
                    
	}
	mysqli_close($connection);
	echo $output;
	exit();
}
 ?>