<?php
require_once("incl/klepet.class.php");
$klepet = new Klepet();

header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: application/xml; charset=utf-8');
echo $klepet->retrieveMsg(0);
exit();
?>