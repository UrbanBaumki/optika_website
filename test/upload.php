<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    ajaxSub();
});


function ajaxSub(){
	$('#ajax').on('submit', function(){
	
	var formData = new FormData($(this)[0]);

    $.ajax({
        url: '../ap/ocalaU.php',
        type: 'POST',
        data: formData,
        async: false,
		beforeSend: function(){
			$('span#sraje').innerHTML = 'Objavljam..';
		},
        success: function (response) {
            console.log(response);
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
<form action="up.php" method="post" id="ajax">
<div><input type="text" name="model" placeholder="Model.." ></div>
<div><input type="text" name="opis" placeholder="Opis izdelka.." ></div>
<div><input type="file" name="ocala"  ></div>
<div><input type="submit" value="Dodaj"></div>
<span id="sraje" style="color:green;"></span>
</form>



</body>
</html>