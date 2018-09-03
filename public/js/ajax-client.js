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
           
            $.ajax({
                url: '/cart/qty',
                method: 'POST',
                data: formData,
                success: function(response){
                   
                    var cartUserTotal = parseInt(response.cartUser[0].total);
                    var num = '$' +cartUserTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $("#total-client" + cart_id).html(num);
                    var cartTotal=parseInt(response.totalCart);
                    num = '$' + cartTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $("#total-items-client").html('<strong>Total</strong>: '+num);
                    $('#client-total').html("El total de su carrito es "+num);
                   
                    
                    
               
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
                    var num = '$' + response.totalUser.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#total-items-client').html("<strong>Total</strong>: $"+num);
                    $('#client-total').html("El total de su carrito es $ "+num);
                    
                    
               
                },

                error: function(response){
                    console.log(response);
                    alert("Intente de nuevo");
                }
        
            });
    });

  

});   