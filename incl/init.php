<?php 
$db = mysqli_connect("localhost","root","","optikaas");
if(mysqli_connect_errno()){
	die("Neuspela povezavica :/". mysqli_connect_error());
}
?>