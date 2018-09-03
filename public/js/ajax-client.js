$(document).ready(function(){
   $(".selectCtd").change(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
            var cart_id=$(this).attr('id');
            var qty=$(this).val();
            var formData = { cart_id  : cart_id, qty: qty};
            console.log(formData);
            $.ajax({
                url: '/cart/qty',
                method: 'POST',
                data: formData,
                success: function(response){
                   
                    console.log(response.cartUser[0].total);

                    $("#total-client" + cart_id).html(response.cartUser[0].total);
                    $("#total-items-client").html('<strong>Total</strong>: $'+response.totalCart);
                    $('#client-total').html("El total de su carrito es $ "+response.totalCart);
                   
                    
                    
               
                },

                error: function(response){
                    console.log(response);
                    alert("Intente de nuevo");
                }
        
            });
   });

    $("#client-body").on('click', '.cart-delete', function(e){
        e.preventDefault();
           
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var cart_id=$(this).val();
            var url= $('#url').val();
            var formData = { cart_id  : cart_id};
            console.log(formData);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response){
                   
                    console.log(response);
                    $("#item-cart" + cart_id).remove();
                    $("#client-container").empty();
                    var nBadge=0;
                    var total=0;
                    response.cartItems.forEach(element => {
                        $("#client-container").append(element.product.product_name+"<br>---------------------<br>");
                        nBadge++;
                        total+=parseInt(element.total);
                    });
                    $('.badge').html(nBadge);
                    $('#total-items-client').html("<strong>Total</strong>: $"+response.totalUser);
                    $('#client-total').html("El total de su carrito es $ "+response.totalUser);
                    
                    
               
                },

                error: function(response){
                    console.log(response);
                    alert("Intente de nuevo");
                }
        
            });
    });

  

});   