<?php

require_once 'incl/init.php';

$sql = "INSERT INTO novice (novica, datum, cas) VALUES ('to je testna novičkaaačččpšš', CURDATE(), CURTIME())";
if($db->query($sql) === TRUE){
	echo "kul";
}else{
	echo "Error: " . $sql . "<br>" . $db->error;
}


?>