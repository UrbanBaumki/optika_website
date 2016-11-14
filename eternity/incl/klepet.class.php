<?php

define("HOST" , "localhost");
define("user" , "userSend");
define("password" , "sranjee");
define("database" , "eternitysi_msg");
require_once('err_handler.php');
class Klepet {
	
	private $mysqli;
	
	function __construct(){
		$this->mysqli = new mysqli(HOST, user, password, database);
	}
	
	function __destruct(){
		$this->mysqli->close();
	}
	
	function queryIt($query){
		return $this->mysqli->query($query);
	}
	public function cleanIt($var){
		return $this->mysqli->real_escape_string($var);
	}
	public function checkUser($username, $password){
		$username = $this->mysqli->real_escape_string($username);
		$password = $this->mysqli->real_escape_string($password);
		$sql = "SELECT username, password FROM users WHERE username = '$username'";
		$rezultat = $this->queryIt($sql);
		$row = $rezultat->fetch_array(MYSQLI_ASSOC);
		$db_username = $row['username'];
		$db_pass = $row['password'];

		if($password == $db_pass && $username == $db_username){
			return True;
		}else{
			return False;
		}

	}
	public function sendMsg($message, $user, $color){
		$msg = $this->mysqli->real_escape_string($message);
		$msg = str_replace("<3", "/3", $msg);
		$username = $this->mysqli->real_escape_string($user);
		$barva = $this->mysqli->real_escape_string($color);
		$sql = "INSERT INTO msg (uID, msg, datum, barva) VALUES ('$username', '$msg', NOW(), '$barva')";

		//Izvedba querya
		$this->queryIt($sql);

	}
	public function retrieveMsg($id){
		$id = $this->mysqli->real_escape_string($id);
		$sql ="";
		if($id == 0){
			$sql = "SELECT msg, id, uID, barva, DATE_FORMAT(datum, '%H:%i') AS datum FROM (SELECT * FROM msg ORDER BY id DESC LIMIT 50) AS Last50 ORDER BY id ASC";
		}else{
			$sql = "SELECT msg, id, uID, barva, DATE_FORMAT(datum, '%H:%i') AS datum FROM msg WHERE id >". $id ." ORDER BY id ASC";
		}
		
		$rezultat =  $this->queryIt($sql);
		
		//XML ODGOVOR
		$odgovor = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
		$odgovor .= '<response>';
		if($rezultat->num_rows){

			while($row = $rezultat->fetch_array(MYSQLI_ASSOC)){
				$msg = $row["msg"];
				$id = $row["id"];
				$username = $row["uID"];
				$color = $row["barva"];
				$date = $row["datum"];
				//odgovor:
				$odgovor .= '<message>';

				$odgovor .= '<id>'.$id.'</id>';
				$odgovor .= '<username>'.$username.'</username>';
				$odgovor .= '<msg>'.$msg.'</msg>';
				$odgovor .= '<color>'.$color.'</color>';
				$odgovor .= '<date>'.$date.'</date>';

				$odgovor .= '</message>';
			}
		}
		$odgovor .= '</response>';
		$rezultat->close();
	
		return $odgovor;
	}
}
?>