$(document).ready(function() {

	$('#loader_registration_id').css("visibility", "hidden");

	src = '/admin/registrations/search/ajax';

	$('#registration_id').autocomplete({


		source: function(request, response) {

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_registration_id').css("visibility", "visible");
		        },

				url: src,
				dataType: 'json',

				data: {
					term: request.term
				},				

				success: function(data) {

					response(data);
				},

		        complete: function() {

		          $('#loader_registration_id').css("visibility", "hidden");

		        }				

			});

		},

		minLength: 1,

		autoFocus: true,

		select: function(event, ui) {

			// alert(ui.item.id);

            $('#registration_id').val(ui.item.value);
            // document.getElementById('registration_id').value = ui.item.value;
        }

	});


});
