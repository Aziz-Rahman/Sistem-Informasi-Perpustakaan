$(function(){
	// GRID
	$('#azz-book').justifiedGallery({
		lastRow : 'justify', 
		rowHeight : 180,
		margins : 1,
	});

	// SEARCH
  	$('.display-search-form').on('click', function(){
  		$('#search-form').fadeIn();
  		$('.search-book').focus();
  	});
  	$('.search-close').on('click', function(){
  		$('#search-form').fadeOut();
  		$('.form-search')[0].reset(); // reset form
  	});

	// Nicescroll
	$('html').niceScroll({
		cursorcolor:"#04CFDC",
		cursoropacitymax: 1,
		cursorwidth: "5px",
		cursorborder: "0",
		cursorborderradius: "0",
		mousescrollstep: 80,
		scrollspeed: 40,
	});

	$('#loader_img').hide(); // set loader hide

	// save contact message
	$(document).on('click', '#save-messages', function(){
		var name = $('#msg-name').val();
		var email = $('#msg-email').val();
		var phone = $('#msg-telp').val();
		var messages = $('#messages').val();

		$('#loader_img').show(); // display loader

		$.ajax({
			type: "post",
			url: "messages.php",
			data: "name="+name+"&email="+email+"&phone="+phone+"&messages="+messages,

			success: function(response) {
				$('.info-warning').html(response);
				$('#loader_img').hide();
			},

			error: function(jqXHR, status, error) {
				alert('Gagal dikirim !');   
			}
		}); // END: ajax  
		return false;       
	});

});