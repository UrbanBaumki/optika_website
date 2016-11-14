<?php
set_error_handler('customErrHandler', E_ALL);

function customErrHandler($number, $text, $file, $line){
	if(ob_get_length()) ob_clean();
	$errMsg = 'Napaka: ' .$number . chr(10) . 
				'Sporočilo: ' .$text . chr(10) . 
				'Datoteka: ' .$file . chr(10) . 
				'Vrstica: ' .$line;
	echo $errMsg;
	exit;
}
?>