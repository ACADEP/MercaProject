$(document).ready(function(){
    

    $(".btn-delete").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id=$(this).val();
        var formData = { id  : id };

        $.ajax({
            url: "/customer/payments/delete",
            method: 'post',
            data: formData,
            success: function(response){
                console.log(response);
                $("#card" + id).remove();
                
            },

            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
    });
});