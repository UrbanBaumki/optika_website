// JavaScript Document<script type="text/javascript">
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
