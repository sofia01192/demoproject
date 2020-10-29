let x = 1;

$(document).ready(function(){
	$('#add-branch').click(function(){
		$('.branches').append('<div class="col-lg-12 branch">'+$('.branch').html()+'</div>');
	})
});


