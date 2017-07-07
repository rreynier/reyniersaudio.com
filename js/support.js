 $(document).ready(function() {
	$('.error').hide();
	$('#ask_question').submit( function(e) {
		e.preventDefault();
		$('.error').hide(500);
		var firstName = $('input#first_name').val();		
		var lastName = $('input#last_name').val();		
		var email = $('input#email').val();		
		var phone = $('input#phone').val();
		var question = $('textarea#question').val();
		if (firstName == "") {
			$('input#first_name').focus().next().show(500);
			return false;
		}
		if (lastName == "") {
			$('input#last_name').focus().next().show(500);
			return false;
		}
		if (email == "") {
			$('input#email').focus().next().show(500);
			return false;
		}
		var dataString = "first_name=" + firstName + "&last_name=" + lastName + "&email=" + email + "&phone=" + phone + "&question=" + question + "&form_submit='ask_question'";
		$.ajax({
			type: "POST",
			url: "index.php?task=browse&view=support",
			data: dataString,
			success: function(content) {                
				$.nyroModalManual({ 
					content: content,
					width: 300, // default Width If null, will be calculate automatically
					height: null, // default Height If null, will be calculate automatically
					minWidth: 50, // Minimum width
					minHeight: 50 // Minimum height
				});
			}
        });
	});		
});		
