$(document).ready(function(){
    $(document).on('submit', '#formulario-de-consulta', function(e){
        e.preventDefault();

        let sucess = $("div.alert-success");
        sucess.remove();
        let diverrores = $("div.errores")
        diverrores.remove();

        let formData = new FormData($('#formulario-de-consulta')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: "POST",
            url: '/enviar-email',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response){
                if(response.status == 400) {
                    console.log(response.errors)
                    if( !$('.errores').length )
                    {
                        var divErrors= '<div class="container errores">';
                        $("form").append(divErrors);
                        $.each(response.errors, function(key, err_value){
                            $('.errores').append('<p class="'+ key + '" style="color:red;">' + err_value + '</p></div>')
                        });
                    } 
                } else {
                    let titulo = $("div.enviar-consulta");
                    titulo.prepend('<div class="alert alert-success" role="alert">'+ response.message + '</div>');
                    $('#formulario-de-consulta').trigger("reset");
                    let sucess = $("div.ck-content");
                    sucess.find("p").empty();
                }
            }

        });
    });
});