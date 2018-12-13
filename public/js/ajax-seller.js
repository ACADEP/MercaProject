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

    $(".btn-delete-invoice").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var sale_id=$(this).val();
        var formData = { sale_id  : sale_id}

        $.ajax({
            url: "/admin/sales/deleteInvoice",
            method: 'post',
            data: formData,
            success: function(response){
                console.log(response);                
            },

            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
    });

});