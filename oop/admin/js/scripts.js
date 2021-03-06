$(document).ready(function(){
    
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );

var href;
var href_splitted;
var user_id;
var image_name;
var photo_id;
    
$(".modal_thumbnails").click(function(){
    $("#set_user_image").prop('disabled', false); 
    href = $("#user-id").prop('href');
    href_splitted = href.split("=");
    user_id = href_splitted[1];
    
    href = $(this).prop("src");
    href_splitted = href.split("/");
    image_name = href_splitted[href_splitted.length - 1];  
    
    photo_id = $(this).attr("data");
    $.ajax({
        url: "includes/ajax_code.php",
        data:{photo_id: photo_id},
        type: "POST",
        success:function(data){
            if(!data.error){
                $("#modal_sidebar").html(data);
            }
        }
    })
});
    
    
$("#set_user_image").click(function(){
    $.ajax({
        url: "includes/ajax_code.php",
        data:{image_name: image_name, user_id:user_id},
        type: "POST",
        success:function(data){
            if(!data.error){
                $(".user-image-box a img").prop('src', data);
            }
        }
    })
});
    
});