$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

$("body").on("click",".delete-post",function(e){

if(!confirm("¿Quieres borrar este post?")) {
    return false;
    }

e.preventDefault();
var id = $(this).data("id");
// var id = $(this).attr('data-id');
var token = $("meta[name='csrf-token']").attr("content");
var url = e.target;

$.ajax(
        {
            url: "/posts/eliminar-post/" + $(this).data("id"),
            type: 'DELETE',
            data: {
            _token: token,
                id: id
        },
        success: function (response){
            window.location.href = '/post-list';
            alert(response)
        }
        });
        return false;
    });

});