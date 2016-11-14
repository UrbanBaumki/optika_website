<?php
$connection = mysqli_connect("localhost" , "upravitelj1", "yy25EFwPKFBaDubU", "optikaas");
if(mysqli_connect_errno()){
	echo "Napaka pri povezavi s podatkovno bazo!";
	exit();
}
?>