ClassicEditor
	.create(document.querySelector('#descripcion-editor'))
	.catch(error => {
		console.error(error);
	});

$(document).ready(function() {
	$(document).on('submit', '#agregar-post-form', function(e) {
		e.preventDefault();

		let sucess = $("div.alert-success");
		sucess.remove();
		let diverrores = $("div.errores")
		diverrores.remove();

		let formData = new FormData($('#agregar-post-form')[0]);

		$.ajaxSetup({
			scriptCharset: "iso-8859-1",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: '/agregar-post',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				if (response.status == 400) {
					console.log(response.errors)
					if (!$('.errores').length) {
						var divErrors = '<div class="container errores">';
						$("form").append(divErrors);
						$.each(response.errors, function(key, err_value) {
							$('.errores').append('<p class="' + key + '" style="color:red;">' + err_value + '</p></div>')
						});
					}
				} else {
					let titulo = $("div.agregar-post");
					titulo.prepend('<div class="alert alert-success" role="alert">El post "' + response.message + '" fue creado con éxito</div>');
					$('#agregar-post-form').trigger("reset");
					$('#descripcion-editor').trigger("reset");
					$('.ck-content').children().text("")
				}
			}

		});
	});
});