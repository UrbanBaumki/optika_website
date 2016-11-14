<?php
require 'check_login.php';
?>
<?php
require_once 'ainit.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administracijska plošča</title>
<link rel="stylesheet" type="text/css" href="../stil/stil.css">
</head>
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
	width: auto;
	height:50px;
	border: 1px solid black;
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
	overflow:hidden;
	padding:10px;
	
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

<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">

function spremeniOcala(){
	
	$("#spremeniOcala").unbind('submit').on('submit', function(){
		
		var formData = new FormData($(this)[0]);
		
		$.ajax({
			url: 'spremeniOcala.php',
			type: 'POST',
			data: formData,
			success: function(response){
				$("#chgOcalaSpan").html(response);
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
        
        
        <?php
			$tip = "";
			$rezultat = "";
			if(isset($_GET['s'])){
				$id = preg_replace("#[^0-9]#","",$_GET['s']);
				$tip = "soncna";
				$rezultat = $connection->query("SELECT * FROM soncna WHERE id='$id'");
			}else if(isset($_GET['k'])){
				$id = preg_replace("#[^0-9]#","",$_GET['k']);
				$rezultat = $connection->query("SELECT * FROM korekcijska WHERE id='$id'");
				$tip = "korekcijska";
			}else{
				
				exit;
			}
		?>
        <div class="wraper">
        		
			
            	<form id="spremeniOcala" >
                	<?php while($row = mysqli_fetch_assoc($rezultat)): ?>
        				<h3>Uredi očala <?=$row['model']?></h3>
           			 	<img src=".<?=$row['slika']?>" width="50%"/>
                    <input type="text" name="id" value="<?=$row['id']?>" style="display:none;"/>
                    <input type="text" name="tip" value="<?=$tip;?>" style="display:none;"/><br>
                    Model <br>
                    <input type="text" name="model" value="<?=$row['model']?>"/><br>
                    Opis <br>
                    <textarea name="opis"><?=$row['opis']?></textarea><br>
                    Velikosti <br>
                    <input type="text" name="velikosti" value="<?=$row['velikosti']?>"/><br>
                    Barve <br>
                    <input type="text" name="barve" value="<?=$row['barve']?>"/><br>
                    Zamenjava slike(neobvezno): <br>
                    <input type="file" name="slika" /><br><br>
                    <input class="btn" type="submit" value="Spremeni!" onClick="spremeniOcala()" /><?php endwhile; ?><span id="chgOcalaSpan" style="color:green;"></span>
                </form><br><br>
            
			<a href="index.php">NAZAJ</a>
        </div>
    </div>

</body>
</html>