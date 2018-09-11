$(document).ready(function(){
    

    $(".btn-delete").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id=$(this).val();
        var formData = { product_id  : product_id}

        $.ajax({
            url: "/delete",
            method: 'DELETE',
            data: formData,
            success: function(response){
                console.log(response);
                $("#product-seller" + product_id).remove();
                
            },

            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
    });
});