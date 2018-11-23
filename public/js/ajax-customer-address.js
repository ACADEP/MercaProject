$(document).ready(function(){
    

    $(".btn-delete-address").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id=$(this).val();
        var formData = { id  : id };
        // console.log($(this).val());

        $.ajax({
            url: "/customer/personal/address/delete",
            method: 'post',
            data: formData,
            success: function(response){
                console.log(response);
                $("#address" + id).remove();
                
            },

            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
    });

    $(".activo").click(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
            var radioactivo=$(this).val();
            var formData = { radioactivo  : radioactivo};
           
            $.ajax({
                url: '/customer/personal/address',
                method: 'POST',
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

   $(".radio-address").ready(function(){
        // alert("radio-address");
    });

    

});