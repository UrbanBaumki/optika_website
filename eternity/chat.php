<?php
require_once("incl/klepet.class.php");
$klepet = new Klepet();
$odziv;
if(isset($_POST['nacin'])){
	$nacin = $_POST['nacin'];
	if($nacin == "preberi"){
		preberiSporocila();
	}else if($nacin == "poslji"){
		poslji();
	}else{
		exit();
	}

}else{
	exit();
}


function preberiSporocila(){
	global $klepet, $odziv;
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$odziv = $klepet->retrieveMsg($id);
	}else{
		exit();
	}
}
function poslji(){
	global $klepet;
	if(isset($_POST['user'], $_POST['msg'], $_POST['color'])){
		$klepet->sendMsg($_POST['msg'], $_POST['user'], $_POST['color']);
		exit();
	}else{
		exit();
	}
	
}
// na koncu vrnemo odgovor
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: application/xml; charset=utf-8');

echo $odziv;
?>