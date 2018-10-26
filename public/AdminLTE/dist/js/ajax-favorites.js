$(document).ready(function(){

    $('.btn-addcart').click(function(e){
        e.preventDefault(); 
      
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
            var productosCart=new Array();
            var productid=$(this).val();
            var url= $('#url').val();
            var formData = { product_id  : $('#product_id'+productid).val(), qty  : $('#qty').val() }
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response){    
                        if(response.user==1)
                        {
                            
                            if(response.itemcount<=5 && response.itemcount>0)
                            {
                    
                                $('#client-container').append(response.item.product_name+"<br>---------------------<br>");
                                $('.badge').html(response.itemcount);
                                var total=parseInt(response.item.total);
                                var num = '$' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                $('#total-items-client').html("<strong>Total</strong>: "+num);
                                $.notify({
                                    // options
                                    message: 'Producto agregado al carrito' 
                                },{
                                    // settings
                                    type: 'success',
                                    delay:1000
                                });
                            }
                            else
                            {
                                if(response.itemcount==0)
                                {
                                    $.notify({
                                        // options
                                        message: '<strong>Este producto ya ha sido agregado</strong>' 
                                    },{
                                        // settings
                                        type: 'warning',
                                        delay:1000
                                    });
                                }
                                else
                                {
                                    $('#cart-detail').html("Ver todos");
                                    $('.badge').html(response.itemcount);
                                    var total=parseInt(response.item.total);
                                    var num = '$' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                    $('#total-items-client').html("<strong>Total</strong>: "+num);

                                    $.notify({
                                        // options
                                        message: 'Producto agregado al carrito' 
                                    },{
                                        // settings
                                        type: 'success',
                                        delay:1000
                                    });
                                }
                                
                            }
                           
                        }
                        else
                        {
                            $.notify({
                                // options
                                message: 'Usuario no autenticado' 
                            },{
                                // settings
                                type: 'danger',
                                delay:3000
                            });
                          
                        }
                    
                },

                error: function(response){
                    console.log(response);
                    alert("Intente de nuevo");
                }
        
            });
        
    });

});