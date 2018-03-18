$(document).ready(function() {

	$('#loader_registration_id').css("visibility", "hidden");
	$('#loader_m_bridal_id').css("visibility", "hidden");
	$('#loader_f_bridal_id').css("visibility", "hidden");
	$('#loader_baptism_parish').css("visibility", "hidden");
	$('#loader_origin_cell').css("visibility", "hidden");
	$('#loader_origin_parish').css("visibility", "hidden");
	$('#loader_destination_parish').css("visibility", "hidden");

	src_reg = '/admin/registrations/search/ajax';
	src_cell = '/admin/cells/search/ajax';
	src_parish = '/admin/parishes/search/ajax';

	// alert(src_reg + '\n' + src_cell + '\n' + src_parish);

	$('#registration_id').autocomplete({		

		source: function(request, response) {

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_registration_id').css("visibility", "visible");
		        },

				url: src_reg,
				dataType: 'json',

				data: {
					term: request.term
				},

				success: function(data) {

					// alert(JSON.stringify(data));

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

	$('#m_bridal_id').autocomplete({

		source: function(request, response) {

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_m_bridal_id').css("visibility", "visible");
		        },

				url: src_reg,
				dataType: 'json',

				data: {
					term: request.term
				},				

				success: function(data) {

					// alert(JSON.stringify(data));

					response(data);
				},

		        complete: function() {

		          $('#loader_m_bridal_id').css("visibility", "hidden");

		        }				

			});

		},

		minLength: 1,

		autoFocus: true,

		select: function(event, ui) {

			// alert(ui.item.id);

            $('#m_bridal_id').val(ui.item.value);
            // document.getElementById('registration_id').value = ui.item.value;
        }

	});

	$('#f_bridal_id').autocomplete({

		source: function(request, response) {

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_f_bridal_id').css("visibility", "visible");
		        },

				url: src_reg,
				dataType: 'json',

				data: {
					term: request.term
				},				

				success: function(data) {

					// alert(JSON.stringify(data));

					response(data);
				},

		        complete: function() {

		          $('#loader_f_bridal_id').css("visibility", "hidden");

		        }				

			});

		},

		minLength: 1,

		autoFocus: true,

		select: function(event, ui) {

			// alert(ui.item.id);

            $('#f_bridal_id').val(ui.item.value);
            // document.getElementById('registration_id').value = ui.item.value;
        }

	});

	$('#origin_cell').autocomplete({

		source: function(request, response) {

			// alert(JSON.stringify(request));	

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_origin_cell').css("visibility", "visible");
		        },

				url: src_cell,
				dataType: 'json',

				data: {
					term: request.term
				},

				success: function(data) {

					// alert(JSON.stringify(data));

					response(data);
				},

		        complete: function() {

		          $('#loader_origin_cell').css("visibility", "hidden");

		        }

			});

		},

		minLength: 1,

		autoFocus: false,

		select: function(event, ui) {			

            $('#origin_cell').val(ui.item.value);
            // document.getElementById('registration_id').value = ui.item.value;
        }

	});
	

	$('#origin_parish').autocomplete({

		source: function(request, response) {

			// alert(JSON.stringify(request));

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_origin_parish').css("visibility", "visible");
		        },

				url: src_parish,
				dataType: 'json',

				data: {
					term: request.term
				},				

				success: function(data) {

					// alert(JSON.stringify(data));

					response(data);
				},

		        complete: function() {

		          $('#loader_origin_parish').css("visibility", "hidden");

		        }				

			});

		},

		minLength: 1,

		autoFocus: false,

		select: function(event, ui) {

			// alert(ui.item.id);

            $('#origin_parish').val(ui.item.value);
            // document.getElementById('registration_id').value = ui.item.value;
        }

	});

	$('#destination_parish').autocomplete({

		source: function(request, response) {

			// alert(JSON.stringify(request));

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_destination_parish').css("visibility", "visible");
		        },

				url: src_parish,
				dataType: 'json',

				data: {
					term: request.term
				},				

				success: function(data) {

					// alert(JSON.stringify(data));

					response(data);
				},

		        complete: function() {

		          $('#loader_destination_parish').css("visibility", "hidden");

		        }				

			});

		},

		minLength: 1,

		autoFocus: false,

		select: function(event, ui) {

			// alert(ui.item.id);

            $('#destination_parish').val(ui.item.value);
            // document.getElementById('registration_id').value = ui.item.value;
        }

	});

	$('#baptismParish').autocomplete({

		source: function(request, response) {

			// alert(JSON.stringify(request));

			$.ajax({
		        
		        beforeSend: function() {

		          $('#loader_baptism_parish').css("visibility", "visible");
		        },

				url: src_parish,
				dataType: 'json',

				data: {
					term: request.term
				},				

				success: function(data) {

					// alert(JSON.stringify(data));

					response(data);
				},

		        complete: function() {

		          $('#loader_baptism_parish').css("visibility", "hidden");

		        }				

			});

		},

		minLength: 1,

		autoFocus: false,

		select: function(event, ui) {

			// alert(ui.item.id);

            $('#baptismParish').val(ui.item.value);
            // document.getElementById('registration_id').value = ui.item.value;
        }
	});
});
