<?php
//check for session
session_start();
if(!isset($_SESSION['usrname'])){
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<title>Eternity</title>
<link rel="stylesheet" type="text/css" href="stil/stil.css">
</head>
<script type="text/javascript">
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'sounds/notification.wav');
audioElement.volume=0.2;
var lastID = 0;
var wait = false;
var waitSend = false;
var lastUser = "";
function playMsg(){
	audioElement.play();
}
function createXHRO() 
{ 
	 var xmlHttp;
	try 
	 { 		 
	 	xmlHttp = new XMLHttpRequest(); 
	 } 
	catch(e) {}
	 	return xmlHttp;
} 
function createAndOpen(){
		var xmlHttpGetMessages = createXHRO(); 
		 xmlHttpGetMessages.open("POST", "chat.php", true); 
		 xmlHttpGetMessages.setRequestHeader("Content-Type", 
	 					"application/x-www-form-urlencoded"); 
		 return xmlHttpGetMessages;	
}

function read(){
	if(wait) return;
	else wait = true;
	var xHttpObj = createAndOpen();	
	xHttpObj.onreadystatechange = function(){
 		if (xHttpObj.readyState == 4 && xHttpObj.status == 200) 
			{ 
				//kaj naredimo z odgovorom
				//koren odgovora (response)
				var response = xHttpObj.responseXML.documentElement;
				var messages = response.childNodes;
				//zanka za parsanje vsakega sporočila posebej
				for(var i = 0; i < messages.length; i++){
					var currentMsg = messages[i];
					//atributi 
					var msgID = currentMsg.childNodes[0].firstChild.data;
					var username = currentMsg.childNodes[1].firstChild.data;					
					var msg = currentMsg.childNodes[2].firstChild.data;
					var color = currentMsg.childNodes[3].firstChild.data;
					var date = currentMsg.childNodes[4].firstChild.data;
				
					lastID = parseInt(msgID);
					addMsg(username, msg, color, date);
					lastUser = username;
				}
				if(lastUser != '<?=$_SESSION['usrname']; ?>' && lastUser != ""){
					playMsg();
					lastUser = "";
				}
				wait = false;
			}else if (xHttpObj.readyState == 4){
				wait = false;
			}
 
	};
	//pošljemo zahtevo na chat.php
	 xHttpObj.send("nacin=preberi&id="+lastID);
}

function addMsg(username, message, color, date){
	var chat = document.getElementById("klepet_vsebina");
	var find = '/3';
	var re = new RegExp(find, 'g');
	var message = message.replace(re, "<3"); 
	var msg ="";
	if(username == '<?=$_SESSION['usrname']; ?>'){
		msg = '<div class="bubble mine"><b>'+username+' <font size="2" face="bookman">('+date+')</font>: </b><font color="'+color+'">'+message+'</font></div>';
	}else{
		msg = '<div class="bubble"><b>'+username+' <font size="2" face="bookman">('+date+')</font>: </b><font color="'+color+'">'+message+'</font></div>';
	}
	chat.innerHTML += msg;

	$('#klepet_vsebina').stop().animate({
  		scrollTop: $("#klepet_vsebina")[0].scrollHeight
		}, 940);
}
function sendMsg(){
	var msg = document.getElementById("msgInput");
	if(msg.value == "") return;
	if(waitSend) return
		else waitSend = true;
	var color = document.getElementById("tColor").value;
	var xHttpObj = createAndOpen();	
	xHttpObj.onreadystatechange = function(){
 		if (xHttpObj.readyState == 4 && xHttpObj.status == 200) 
			{ 
				msg.value = "";
				waitSend = false;
			}
		else if(xHttpObj.readyState == 4 ){
			waitSend = false;
		}
 
	};
	//pošljemo zahtevo na chat.php
	 xHttpObj.send("nacin=poslji&user=<?=$_SESSION['usrname']; ?>&msg="+msg.value+"&color="+color);
}
window.onload = function (){
var input = document.getElementById("msgInput");
input.addEventListener("keypress", function(e){
	var key = e.keyCode ? e.keyCode : e.which;

		if(key == 13)
			{
				sendMsg();
			}
});


};

setInterval(read, 700);

</script>

<body>
<div id="glava">
</div>
<!--Ovoj-->
<div id="wraper">
	<!--Leva stran vsebine-->
	<div id="leva"><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p><p>Leva mačka</p></div>
    <!--Konec leve strani-->
    <!--Desna stran vsebine-->
    <div id="desna"><p>Desna zaspana mačka</p></div>
    <!--Konec desne strani vsebine -->
</div>
<!--Konec ovoja-->
<!--Klepet ovoj-->
<div id="klepet_wraper">
	<div id="klepet">
		<div id="klepet_vsebina"></div>	
		<div id="klepet_input"><input type="text" id="msgInput" placeholder="Napiši nekaj.."/><input type="color" name="tColor" id="tColor"/></div>
		<button id="b_poslji" onclick="sendMsg()">Pošlji</button>
		
	</div>
</div>
<!--Konec klepet ovoja-->


<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/sticky.js"></script>
</body>
</html>