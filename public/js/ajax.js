$(document).ready(function(){
   

    $('.btn-addcart').click(function(e){
        e.preventDefault(); 
       
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
         
            var productid=$(this).val();
            var url= $('#url').val();
            var formData = { product_id  : $('#product_id'+productid).val(), qty  : $('#qty').val() }
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response){
                    console.log(response.product.id);
                     $('#product_container').html(response.product.id);
               
                },

                error: function(response){
                   console.log(response);
                    
                }
        
            });
        
    });

   
});