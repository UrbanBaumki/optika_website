<?php

function generateSalt($max = 16) {
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $salt = "";
       	for($i = 0; $i < $max ; $i++){
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
		}
        
        return $salt;
}
$salt = generateSalt();
echo "Salt: ". $salt.'<br>';
$password = "sranje";
echo "Input: ". $password.'<br>';
echo "Hash: ".crypt($password, $salt );
?>