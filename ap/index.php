<?php
require 'check_login.php';
?>
<?php
include_once 'ainit.php';
?>
<?php 
//Izbris novic in objava

 if(isset($_POST['novica'])){
	$novica = $_POST['novica'];
	$nSql = "INSERT INTO novice (novica, datum, cas, uporabnik) VALUES('$novica', CURDATE(),CURTIME(), '$manager')";
	
	if($connection->query($nSql)){
		echo "Novica uspešno dodana!";
		exit();
	}else{
		echo "Neuspešno dodano, nekaj se je zalomilo :(";
		exit();
	}
}
//Za brisanje
if(isset($_POST['del'])){
	$id = preg_replace("#[^0-9]#i","", $_POST['del']);

	$delSql = "DELETE FROM novice WHERE id='$id'";
	if($connection->query($delSql)){
		echo "deleted";
		exit();
	}else{
		echo "Novica ni bila odstranjena :/, nekaj se je zalomilo..";
		exit();
	}
	
	
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administracijska plošča</title>
<link rel="stylesheet" type="text/css" href="../stil/stil.css">
</head>
<script src="ajax.js"></script>
<script src="ocalaU.js"></script>
<style>
input.btn {
	background-color:white;
	width:60px;
	height:30px;
	border-radius:6px;
	border:none;
}
input.btn:hover {
	background-color:#00adef;
	color:white;
}
#holder {
	width: 80%;
	height:50px;
	
	margin: 0 auto;
	margin-top: 10px;
	
}
ul{
	height:100%;
	list-style:none;
	margin: 0 auto;
	position:relative;
}
li{

}
#holder > ul > li > a{
	font-size: 25px;
	width:auto;
	height:40px;
	background-color:#00adef;
	color:white;
	text-decoration:none;
	float:left;
	padding-left: 10px;
	padding-right: 10px;
	transition: all 0.1s linear;
	padding-top: 10px;
}
#holder > ul > li > a:hover{
	background-color:#FF9A35;
	color:black;
}
.wraper{
	width: 90%;
	min-height: 400px;
	border: 1px dashed black;
	margin: 0 auto;
	border-radius: 6px;
	display: none;
	overflow:hidden;
	
}
input {
	float:left; 
}
button#btn {
	background-color:white;
	width:60px;
	height:30px;
	border-radius:6px;
	border:none;
}
button#btn:hover {
	background-color:#00adef;
	color:white;
}
#rightSplit {
	width: 50%;
	height:100%;
	float: right;
}
#novica{
	clear:both;	
	float:left;
	padding:6px;
	width: 80%;
}
#leftSplit {
	width:40%;
	height:100%;
	padding:10px;
	float:left;
}
#leftSplit > p {
	margin-left: 10px;
	display:block; 
	width:200px;
	height:auto;	

	border-bottom:1px solid gray;
}
</style>
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
function deleteNews(id){
	var nid = id;
	if(nid != ""){
		_(nid).innerHTML = '<text style="color:green;">Brisanje...</text>';
		hideEl("btn"+id);
		var ajax = ajaxObj("POST", "index.php");
		
		ajax.onreadystatechange = function(){
			
			if(ajaxReturn(ajax) == true){
				var response = ajax.responseText;
				if(response == "deleted"){
					_(id).innerHTML = '<text style="color:green;">Uspešno odstranjeno!</text>';
					hideEl("pN"+nid);
				}else{
					unHide("btn"+nid);
					_(id).innerHTML = response;
				}
			}
		}
		ajax.send("del="+nid);
	}
}
function hideEl(elem){
	_(elem).style.display = "none";
}
function unHide(elem){
	_(elem).style.display = "block";

}
function _(elem){
	return document.getElementById(elem);	
}
function submitNews(){
	var news = _("novica").value;
	if(news != "") {
		_("subNewsSpan").innerHTML = 'objavljam...';
		var ajax = ajaxObj("POST", "index.php");
		
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true){
				_("subNewsSpan").innerHTML = ajax.responseText;
			}
			
		}
		ajax.send("novica="+news);
	}
}
function deleteOcala(id, type){
	var oID = id;
	var type = type;
	var btnandSpan= "";
	if(type == 0){
		btnandSpan = "son"+oID;
	}else if (type == 1){
		btnandSpan = "kor"+oID;
	}
	if(oID != ""){
		_("S"+btnandSpan).innerHTML = 'Brišem..';
		_(btnandSpan).style.display = "none";
		var ajax = ajaxObj("POST" , "delOcala.php");
		
		ajax.onreadystatechange = function (){
			if(ajaxReturn(ajax) == true){
				var response = ajax.responseText;
				
				if(response != "Izbrisano"){
					_(btnandSpan).style.display = "block";

				}
				_("S"+btnandSpan).innerHTML = ajax.responseText;
			}
				
			
		}
		ajax.send("ocala="+oID+"&type="+type);
	}
}

function izbira(x){
	var i = x;
	
	var ajax = ajaxObj("POST" , "getZnamke.php");
		
		ajax.onreadystatechange = function (){
			
			if(ajaxReturn(ajax) == true){
				var response = ajax.responseText;
				_("selectznamka").innerHTML = ajax.responseText;
			}
			
		}
		
	if(i == 0){
		
		ajax.send("znamke="+0);
		
	}
	else if(i == 1){
		
		ajax.send("znamke="+1);
	}
}

function submitForm(form, url, span){
	
	$('#'+form).unbind('submit').on('submit', function(){
		var formData = new FormData($(this)[0]);
		$.ajax({
			url: url+'.php',
			type: 'POST',
			data: formData,
			success: function(response){
				_(span).innerHTML = response;
			},
			error: function(response){
				console.log(response);
			},
			cache: false,
			contentType: false,
			processData: false
		});
		return false;
		
	});
	
}

function izbrisiAkcijo(id){
	var oID = id;
	
	if(oID != ""){
		_(oID).style.display = "none";
		var ajax = ajaxObj("POST" , "delAkcija.php");
		
		ajax.onreadystatechange = function (){
			if(ajaxReturn(ajax) == true){
				var response = ajax.responseText;
				
				if(response != "Izbrisano"){
					_(oID).style.display = "block";

				}
				_("h"+oID).innerHTML = ajax.responseText;
			}
				
			
		}
		ajax.send("delA=" + oID);
	}
}

function enablePic(id, prikaz){
	var oID = id;
	if(oID != ""){
		_("but"+oID).style.display = "none";
		var ajax = ajaxObj("POST" , "togA.php");
		
		ajax.onreadystatechange = function (){
			if(ajaxReturn(ajax) == true){
				var response = ajax.responseText;
				if(response != "Izbrisano"){
					_(oID).style.display = "block";

				}
				
			}
				
			
		}
		
		if(prikaz == 1){
			ajax.send("dis=" + oID);
		}else{
			ajax.send("en=" + oID);
		}
		
	}
}
</script>

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
        <h2 align="center">Administracijska plošča</h2>
        
        <div id="holder">
            <ul>
                <li><a href="#" id="ocala">OČALA</a></li>                
                <li><a href="#" id="okul">OKULISTIČNI</a></li>
                <li><a href="#" id="akcije">AKCIJE</a></li>
                <li><a href="#" id="novice">NOVICE</a></li>
                <li><a href="logout.php">ODJAVA</a></li>
            
            </ul>
        
        </div>
        
        <!-- OČALA WRAPER -->
        <div class="wraper" id="oW">
        	<?php $ocalaView = "SELECT * FROM znamke JOIN soncna USING(zid)"; 
			$query = $connection->query($ocalaView);
			?>
           <div style="width:50%; height:100%; float:left;">
                   <h3>Uredi</h3>
					<!-- UREJANJE SONČNIH OČAL -->
                    <h4>Sončna očala</h4>
           		<?php while($row = mysqli_fetch_assoc($query)) : ?>
               <div style="width:140px; min-height:60px; background:#333; color:white; margin-top:10px; margin-left: 10px; margin-bottom:10px; padding:4px; float:left; font-size:10px; overflow:hidden;">
               		<p><?= $row['znamka'].'<br>'.$row['model'];?></p><img src="<?= '.'.$row['slika'];?>" width="40%" height="40%" /><br><span id="<?='Sson'. $row['id'];?>"></span>
                    <button id="<?= 'son'.$row['id'];?>" onClick="deleteOcala(<?= $row['id'].', 0';?>)">Izbriši</button><a style="color:black; text-decoration:none;" href="uredi.php?s=<?=$row['id']?>"><button>Uredi</button></a>
               </div>
               <?php endwhile; ?>
               		<!-- UREJANJE KOREKCIJSKIH OČAL -->
                    <h4 style="clear:both;">Korekcijska očala</h4>
               <?php $ocalaView = "SELECT * FROM znamke JOIN korekcijska USING(zid)"; 
					$query = $connection->query($ocalaView);
				?>
               <?php while($row = mysqli_fetch_assoc($query)) : ?>
               <div style="width:140px; min-height:60px; background:#333; color:white; margin-top:20px; margin-left: 10px; padding:4px; float:left; font-size:10px; overflow:hidden;">
               		<p><?= $row['znamka'].'<br>'.$row['model'];?></p><img src="<?= '.'.$row['slika'];?>" width="40%" height="40%" /><br><span id="<?='Skor'. $row['id'];?>"></span>
                    <button id="<?= 'kor'.$row['id'];?>" onClick="deleteOcala(<?= $row['id'].', 1';?>)">Izbriši</button><a style="color:black; text-decoration:none;" href="uredi.php?k=<?=$row['id']?>"><button>Uredi</button></a>
               </div>
               <?php endwhile; ?>
           </div>
           <!-- DESNA STRAN -->
           <div style="width:50%; height:100%; float:left;">
           				<!-- DODAJANJE ZNAMK -->
           			<h3 style="border-bottom:1px solid gray;">Dodaj znamko</h3>
                     <br>
             <form id="addZnamka" >
                   <input type="text" name="znamka" placeholder="Ime znamke.."><br>
               <h5>Dodaj k:</h5>
                      <label>
                        <input type="radio" name="vrsta" value="soncna" id="vrsta_0">
                        Sončna očala</label>
                      <br>
                      <label>
                        <input type="radio" name="vrsta" value="korekcijska" id="vrsta_1">
                        Korekcijska očala</label>
                      <br>
                      <input class="btn" id="znamkaAdd" type="submit" value="Dodaj" onClick="submitForm('addZnamka','dodajZnamko','spanZnamkaAdd')"> <span style="color:green;" id="spanZnamkaAdd"></span>
               </form><br><br>
               
               			<!-- DODAJANJE  OČAL -->
                   <h3 style="border-bottom:1px solid gray;">Dodaj očala</h3>
 					<br>
           		<form action="up.php" method="post" id="ocalaUploadForm">
                	<h5>Vrsta očal:</h5>                    
                      <label>
                        <input onClick="izbira(0)" type="radio" name="vrstaOcal" value="soncna" id="vrstaOcal_0">
                        Sončna o.</label>
                      <br>
                      <label>
                        <input onClick="izbira(1)" type="radio" name="vrstaOcal" value="korekcijska" id="vrstaOcal_1">
                        Korekcijska o.</label>
                      <br>
                   
			<div>Znamka:
          <select  name="znamka" id="selectznamka">
                    	
                    </select></div>
                    <div><input type="text" name="model" placeholder="Model.."  size="20"></div><br>
                    <div><textarea type="text" name="opis" placeholder="Opis izdelka.." style="width: 90%; height:100px;"></textarea></div>
                    <h5>Dodatne info.:</h5>
                    <div><input type="text" name="velikosti" placeholder="Velikosti.."  size="30"></div><br>
					<div><input type="text" name="barve" placeholder="Barve.."  size="30"></div><br>

                    <div><input type="file" name="ocala"  ></div><br>
                    <div style="clear:both;"><input class="btn" type="submit" value="Dodaj" style="float:left; clear:both;" onClick="submitForm('ocalaUploadForm','ocalaU','stanjeOcala')"></div>
                    <span id="stanjeOcala" style="color:green;"></span>
                </form>
           </div>
        	
        </div>
        
        <!-- OKULISTIČNI PREGLEDI WRAPER -->
        <div class="wraper" id="okW">
        	<h3>Dodajanje terminov okulističnega pregleda za tekoči mesec</h3>
            <form  method="post" onSubmit="return false;" id="termini">
            	Mesec<br><input type="text" name="mesec"placeholder="Mesec.. z besedo npr.:JANUAR" size="30"></label><br>
               Leto<br><input type="text" name="leto" value="2015" size="4"></label><br>
                Termini: <br><textarea style="width: 40%;" name="termini" placeholder="03.07.2015(PON): 16:00; 12.07.2015(SRE): 15:00 ...KOMENTAR: Termine loči s podpičjem (;)"></textarea><br>
                <button onclick="submitForm('termini','dodajTermin','terminspan')" id="btn">Objavi</button><span style="color:green;" id="terminspan"></span>
            </form>
            
        </div>
        <!-- AKCIJE WRAPER -->
        <div class="wraper" id="aW">
        	<div id="leftSplit">
                <h3>Dodaj obvestilo akcije</h3>
                <form method="post" onSubmit="return false;" id="akcijaForm">
                 Akcija: <br><input type="text" name="akcija" /><br>
                 Opis: <br><textarea type="text" name="opis" ></textarea><br>
                 Slika(neobvezno): <br><input type="file" name="slika" /><br><br>
                 <button onClick="submitForm('akcijaForm', 'dodajAkcije','akcijespan')" id="btn">Objavi</button><span style="color:green;" id="akcijespan"></span>
                 
                </form><br>
                
                
                <h3>Dodaj NASLOVNO akcijo</h3>
                <form method="post" onSubmit="return false;" id="naslovnaAkcija">
                 Opis(neobvezen): <br><input type="text" name="opis" /><br>
                 Slika(obvezno): <br><input type="file" name="slika" /><br><br>
                 <button onClick="submitForm('naslovnaAkcija', 'dodajNaslovnoAkcijo','naslovnaSpan')" id="btn">Objavi</button><span style="color:green;" id="naslovnaSpan"></span>
                 
                </form>
                </div>
        		<div id="rightSplit">
                	<h3>Uredi akcije</h3>
                    <?php 
						$rez = $connection->query("SELECT * FROM akcije ORDER BY id DESC");
						while($row = mysqli_fetch_assoc($rez)) : 
					?>
                    <br><h4 id="<?='h'.$row['id']?>"><?=$row['naziv']?></h4><input id="<?=$row['id']?>" type="submit" onclick="izbrisiAkcijo('<?=$row['id']?>')" value="Izbirši"/><br>
                    <?php endwhile;?><br>
                    
                    <h3>Prikaz naslovne akcije (slika): </h3>
                    <?php
						$rez = $connection->query("SELECT * FROM akcije_slika ORDER BY id DESC LIMIT 1");
						if(mysqli_num_rows($rez) == 1){
							$row = mysqli_fetch_assoc($rez);
							$id = $row['id'];
							echo '<img src=".'.$row['slika'].'" width="70%" />';
							echo '<input id="but'.$row['id'].'" type="submit" onclick="enablePic('.$id.', '.$row['prikaz'].')" value="Skrij/prikaži" />';
						}
					 ?>
                </div>
        </div>
        
        <!-- NOVICE WRAPER -->
        <div class="wraper" id="nW">
        	<!-- LEVA STRAN -->
        	<div id="leftSplit">
            <h4 align="left">Uredi novice</h4>
            	<?php $slqn = "SELECT * FROM novice ORDER BY datum DESC, cas DESC"; 
					$nQuery = $connection->query($slqn);
					while($row = mysqli_fetch_assoc($nQuery)) : ?>
             		<p id="<?='pN'.$row['id'];?>"><?php echo $row['novica'] ?></p><span id="<?= $row['id']?>"></span>&nbsp;&nbsp;<button onclick="deleteNews(<?=$row['id'];?>)" id="<?='btn'.$row['id'];?>">Izbriši</button><br>		<br>
                	<?php endwhile; ?>
            </div>
            <!-- DESNA STRAN -->
        	<div id="rightSplit">
            	<h4 align="left">Objavi novico</h4>
                <form name="submitnews" id="submitnews" onsubmit="return false;">
                <textarea id="novica" placeholder="Napiši kratko novico.." type="text"  name="novica"></textarea>
                <button onclick="submitNews()" id="btn">Objavi</button><span style="color:green;" id="subNewsSpan"></span>
                </form>
       		 </div>
        </div>
    </div>
    
    
    <script src="../js/p.js"></script>
</body>
</html>