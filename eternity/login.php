<?php
session_start();
if(isset($_SESSION['usrname'])){
	header("Location: index.php");
	exit();
}else{
	if(isset($_POST['username'], $_POST['password'])){
		$user = $_POST['username'];
		$pass = $_POST['password'];
		require_once("incl/klepet.class.php");
		$klepet = new Klepet();
		if($klepet->checkUser($user, $pass)){
			$user = $klepet->cleanIt($user);
			$_SESSION['usrname'] = $user;
			header("Location: index.php");
			exit();
		}else{
			echo 'NAPAČNO UP.IME ali GESLO!';
			exit();
		}

	}

}

?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<title>Eternity</title>
<link rel="stylesheet" type="text/css" href="stil/stil.css">
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
	height:25px;
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
<div id="glava">
</div>
<!--Ovoj-->
<div id="wraper">
	<div id="aContent">
	<h3 align="center" style="color:white">Prijava</h3>
            <div id="prijava">
            <form method="post" action="login.php">
	            <input name="username" placeholder="Up. ime"><br>
	            <input name="password" type="password" placeholder="Geslo"><br>
	            <input type="submit" value="Prijava" id="btn">
	           
            </form>
            </div>
        </div>


</div>
<!--Konec ovoja-->



<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/sticky.js"></script>
</body>
</html>