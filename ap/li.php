<?php
session_start();
if(isset($_SESSION['oamanager'])){
	header("Location: ./index.php");
	exit();
}

?>

<?php 
$obvestilo = "";
if(isset($_POST['username']) && isset($_POST['password'])){
	
	$manager = preg_replace("#[^A-Za-z0-9]#i","",$_POST['username']);
	$pass = preg_replace("#[^A-Za-z0-9]#i","",$_POST['password']);
	
	require_once '../incl/init.php';
	$sql = "SELECT * FROM uporabniki WHERE ime='$manager' LIMIT 1";
	$query = $db->query($sql);
	$obstaja = mysqli_num_rows($query);	
	if($obstaja == 1){
		while($row = mysqli_fetch_assoc($query)){
			$id = $row['id']; //pridobimo uporabnikov id
			$username = $row['ime'];
			$password = $row['geslo'];
			$salt = $row['sol'];
		}
		if(crypt($pass, $salt) == $password){
			$_SESSION["id"] = $id;
			$_SESSION["oamanager"] = $username;
			$_SESSION["password"] = $password;
			header("Location: index.php");
			exit();
		}else{
			$obvestilo = "Nepravilno geslo ali uporabniško ime!";
		}
		
		
	}else{
		$obvestilo = "Nepravilno geslo ali uporabniško ime!";
	}
	
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Prijava</title>
<link rel="stylesheet" type="text/css" href="../stil/stil.css">
</head>
<style>
#prijava {
	width: 250px;
	height:auto;
	margin: 0 auto;
	border:1px solid white;
	border-radius: 6px;

	padding:10px;
background: rgb(224,224,224);
background: -moz-linear-gradient(top,  rgba(224,224,224,1) 0%, rgba(206,206,206,1) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(224,224,224,1)), color-stop(100%,rgba(206,206,206,1)));
background: -webkit-linear-gradient(top,  rgba(224,224,224,1) 0%,rgba(206,206,206,1) 100%);
background: -o-linear-gradient(top,  rgba(224,224,224,1) 0%,rgba(206,206,206,1) 100%);
background: -ms-linear-gradient(top,  rgba(224,224,224,1) 0%,rgba(206,206,206,1) 100%);
background: linear-gradient(to bottom,  rgba(224,224,224,1) 0%,rgba(206,206,206,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e0e0e0', endColorstr='#cecece',GradientType=0 );


}
form > input {
	color:#00adef;
	margin-bottom: 6px;
	height:20px;
	padding:6px;
}
form > input#btn {

	width:60px;
	height:30px;
	border-radius:6px;
	border:none;
}
form > input#btn:hover {
	background-color:#00adef;
	color:white;
}
</style>
<body>

    <div id="headWrap">
           <div id="hSplitterLeft">
               <a class="logoL" href="/" title="Optika As"></a>
           </div>
           
        </div>
        
        
        <!-- end of Header -->
        <div id="searchRib">
            
        </div>
        <div id="aContent">
        	<h3 align="center">Prijava</h3>
            <div id="prijava">
            <form method="post" action="li.php">
            <input name="username" placeholder="Up. ime"><br>
            <input name="password" type="password" placeholder="Geslo"><br>
            <input type="submit" value="Prijava" id="btn">
            <?= $obvestilo;?>
            </form>
            </div>
        </div>
</body>
</html>