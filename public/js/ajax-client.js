$(document).ready(function(){
    
    $(".btn-favorite").click(function(){
        var product_id=$(this).val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/customer/addfavorite',
            method: 'POST',
            data:{product_id:product_id},
            success: function(response){ 
              
               if(response.favorite_val)
               {
                    $.notify({
                        // options
                        message: '<i class="fa fa-heart" aria-hidden="true"></i> <strong>Agregado a favoritos</strong>' 
                    },{
                        // settings
                        type: 'success',
                        delay:1000
                    });
                }
                else
                {
                    $.notify({
                        // options
                        message: '<strong>Este producto ya existe en favoritos</strong>' 
                    },{
                        // settings
                        type: 'warning',
                        delay:1000
                    });
                }
                
            },

            error: function(response){
                alert("Intente de nuevo");
            }
    
        });
        
       
    });
    

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
                   
                    var cartUserTotal = parseFloat(response.cartUser[0].total);
                    var num = '$' +cartUserTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $("#total-client" + cart_id).html(num);
                    var cartTotal=parseFloat(response.totalCart);
                    num = '$' + cartTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $("#total-items-client").html('<strong>Total</strong>: '+num);
                    $('#client-total').html("El total de su carrito es "+num);
                    
                   
                    
                    
               
                },

                error: function(response){
                    
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
            
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response){
                   
                   
                    $("#item-cart" + cart_id).remove();
                    $("#client-container").empty();
                    var nBadge=0;
                    var total=0;
                    
                    response.cartItems.forEach(element => {
                        var num = '$' + parseFloat(element.real_price).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                        $("#client-container").append('<div class="col-md-3"> <img  style="width:100%;" src="'+element.product.photos[0].path+'"></div>'+
                        '<div class="col-md-9" ><span class="badge badge-primary" style="font-size:12px; width:100%;">'+element.product.product_name+'</span> <br>'+
                        '<span class="badge badge-success">'+num+'</span> </div>'+
                        '<div class="col-md-12"><hr></div>');
                        nBadge++;
                        total+=parseInt(element.total);
                    });
                    $('#badge-cart').html(nBadge);
                    var num = '$' + response.totalUser.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#total-items-client').html("<strong>Total</strong>: "+num);
                    $('#client-total').html("El total de su carrito es "+num);
                  
                    if( response.totalUser==0)
                    {
                        $("#btn-pay-div").html("");
                        $("#alert-cartP-A").html("No hay productos en el carrito");
                        $('#client-container').html(" <div class='col-md-12 text-center'>No hay productos en el carrito</div>");
                        $("#alert-cartP-A").css("height","230px");
                    }
                    if($("#body-cart").height()<=160)
                    {
                        $("#body-cart").height(300);
                    }
                    
                    
               
                },

                error: function(response){
                    
                    alert("Intente de nuevo");
                }
        
            });
    });

    $(".radio-address").click(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var address_id=$(this).val();

        var formData = { address_id  : address_id};
            
            $.ajax({
                url: '/updateAddressActive',
                method: 'POST',
                data: formData,
                success: function(response){
                    var numExterior="No especificado";
                    var numInterior="No especificado";
                    var referencias="No especificado";
                    if(response.numExterior!=null)
                    {
                        numExterior=response.numExterior;
                    }
                    if(response.numInterior!=null)
                    {
                        numInterior=response.numInterior;
                    }
                    if(response.referencias!=null)
                    {
                        referencias=response.referencias;
                    }
                   $("#address-ship").html("&nbsp;<i class='fa fa-map-marker fa-lg' aria-hidden='true'></i> <strong>CP:</strong>"+response.cp+" <br>"+ 
                        "<strong>&nbsp;Ciudad:</strong>"+response.ciudad+" "+response.estado+" <br>"+
                        "<strong>&nbsp;Calles:</strong> "+response.calle+"  entre "+response.calle2+" y "+response.calle3+" <br>"+ 
                        "<strong>&nbsp;Colonia:</strong> "+response.colonia+" <br>"+
                        "<strong>&nbsp;Número exterior:</strong> "+numExterior+" <br>"+
                        "<strong>&nbsp;Número interior:</strong> "+numInterior+" <br>"+
                        "<strong>&nbsp;Referencias: </strong> "+referencias+"");
                    $("#address-active").val(JSON.stringify(response));
                },

                error: function(response){
                    alert("Intente de nuevo");
                }
        
            });
    });

  

});   