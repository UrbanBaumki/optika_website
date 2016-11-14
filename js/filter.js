$("#filterGroupForm").unbind('submit').on('submit', function(){
	var formData = new FormData($(this)[0]);
	$.ajax({
			url: 'incl/filter.php',
			type: 'POST',
			data: formData,
			success: function(response){
				$("#poravnava").html(response);
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

function objavi(){
	$("#filterGroupForm").submit();
	
}