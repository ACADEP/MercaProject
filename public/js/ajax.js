$(document).ready(function(){

    

    $('#tbody').on('click', '.show-product', function(e){
        e.preventDefault();
        window.location.replace("/product/"+$(this).attr('id'));

    });
    $('#tbody').on('change', '.selectqty', function(e){
        e.preventDefault();
        var productosJson=jQuery.parseJSON(Cookies.get("productos"));
        var max=productosJson.length;
        var i=0;
       
        for(i;i<max;i++)
        {
            if($(this).attr('id') == 'selectQty'+i+'')
            {
                var qty=parseInt($( '#selectQty'+i+'').val());
                var pPriceTotal=parseFloat(productosJson[i].real_price)*qty;
                var num = '$' + pPriceTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $("#subtotal"+i+"").html(num);
                productosJson[i].qty=qty;
                Cookies.set("productos",productosJson,1);
                $("#items-carts").val(JSON.stringify(productosJson));
                var numTotal = '$' + getTotal().toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                // $('#total-items').html("<strong>Total</strong>: "+numTotal);
                $('#general-total').html("El total de su carrito es "+numTotal);
            }
        }
        
    });
        

    
    //Mostar productos seleccionados previamente
    mostrarElementos();
    if($("#body-cart").height()<=160)
    {
        $("#body-cart").height(300);
    }
    $('#tbody').on('click', '.click-delete', function(e){
        e.preventDefault();
        var productosJson=jQuery.parseJSON(Cookies.get("productos"));
       
        productosJson.splice(this.id, 1);
        
        Cookies.set("productos",productosJson,1);
        mostrarElementos();
        if($("#body-cart").height()<=160)
        {
            $("#body-cart").height(300);
        }
    });

    $('.btn-pay').click(function(){
        //Borrar los cookies
        var i=1;
        while(Cookies.get("productos"+i)!=null)
        {
            Cookies.remove("productos"+i);
        }
        Cookies.remove("numProductos");
        $('#product_container').html("");
        $('#badge-cart').html(0);
    });
    
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
                            if(response.itemcount==1)
                            {
                                $('#client-container').empty();
                            }
                            
                            if(response.itemcount<=5 && response.itemcount>0)
                            {
                                
                                var num = '$' + parseFloat(response.item.real_price).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                $('#client-container').append('<div class="col-md-3"> <img  style="width:100%;" src="'+response.img_product+'"></div>'+
                                '<div class="col-md-9" ><span class="badge badge-primary" style="font-size:12px; width:100%;">'+response.item.product_name+'</span> <br>'+
                                '<span class="badge badge-success">'+num+'</span> </div>'+
                                '<div class="col-md-12"><hr></div>');
                                $('#badge-cart').html(response.itemcount);
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
                                    $('#badge-cart').html(response.itemcount);
                                    

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
                            if(productoAgregado(response.item.id))
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
                                if(Cookies.get("productos")!=null)
                                {
                                    var productosJSON=jQuery.parseJSON(Cookies.get("productos"));
                                    productosCart=productosJSON;
                                }
                                productosCart.push(response.item);
                                Cookies.set("productos",productosCart,1);
                                if(productosCart.length<=1)
                                {
                                    $('#product_container').empty();
                                }
                                if(productosCart.length<=5)
                                {
                                    var num = '$' + parseFloat(response.item.real_price).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                    $('#product_container').append('<div class="col-md-3"> <img  style="width:100%;" src="'+response.img_product+'"></div>'+
                                    '<div class="col-md-9" ><span class="badge badge-primary" style="font-size:12px; width:100%;">'+response.item.product_name+'</span> <br>'+
                                    '<span class="badge badge-success">'+num+'</span> </div>'+
                                    '<div class="col-md-12"><hr></div>');
                                }
                                else
                                {
                                    $('#cart-detail').html("Ver todos");
                                }
                                $('#badge-cart').html(productosCart.length);
                               
                                //Notificacion
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
                    
                },

                error: function(response){
                    console.log(response);
                    alert("Intente de nuevo");
                }
        
            });
        
    });

    function refresh()
    {
        $('#product_container').empty();
        $('#tbody').empty();
              
    }

    function mostrarElementos()
    {   refresh();
     
      
      
        if(Cookies.get("productos")!=null )
        {
            var i=0;
            var nBadge=0;
           
            var productosArray=jQuery.parseJSON(Cookies.get("productos"));
            $("#items-carts").val(JSON.stringify(productosArray));
            var maxElements=parseInt(productosArray.length);
            if(maxElements<=0)
            {
                $("#alert-cartP").html("No hay productos en el carrito");
                $('#product_container').html("<div class='col-md-12 text-center'>No hay productos en el carrito</div>");
                $("#alert-cartP").css("height","230px");
            }
            for(i;i<maxElements;i++)
            {
               
                    nBadge++;
                    var producto=productosArray[i];
                    if(i<=4)
                    {
                        var num = '$' + parseFloat(producto.real_price).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                        $('#product_container').append('<div class="col-md-3"> <img  style="width:100%;" src="'+producto.img+'"></div>'+
                        '<div class="col-md-9" ><span class="badge badge-primary" style="font-size:12px; width:100%;">'+producto.product_name+'</span> <br>'+
                        '<span class="badge badge-success">'+num+'</span> </div>'+
                        '<div class="col-md-12"><hr></div>');
                    }
                    else
                    {
                        $('#cart-detail').html("Ver todos");
                    }
                    
                    
                    //Mostrar los productos en la vista detalles de carrito
                    var pPriceTotal=parseFloat(producto.real_price);
                    var num = '$' + pPriceTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                  
                    $('#tbody').append("<tr>");
                    $('#tbody').append(" <td style='width:100px;'><img style='width:100%;' src="+producto.img+" ></td>");
                    $('#tbody').append("<td><a class='show-product' id='"+producto.product_name+"' style='text-decoration:none;'>"+producto.product_name+"</a></td>");
                    $('#tbody').append("<td>"+num+"</td>");
                    var k=0;
                    $('#tbody').append("<td><select class='form-control selectqty' id='selectQty"+i+"'>");
                    for(k;k<producto.product_qty;k++)
                    {
                        $('#selectQty'+i+'').append("<option value='"+(k+1)+"'>"+(k+1)+"</option>");
                    }
                    $('#tbody').append("</select></td>");
                    $('#selectQty'+i+'').val(producto.qty);
                    var qty=parseInt($( '#selectQty'+i+'').val());
                    
                    num = '$' + (pPriceTotal*qty).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#tbody').append("<td id='subtotal"+i+"'>"+num+"</td>");
                  
                    $('#tbody').append("<td><button type='button' class='btn btn-outline-danger btn-sm click-delete'  id='"+i+"'><i class='fa fa-trash' aria-hidden='true'></i></button></td>");
                    $('#tbody').append("</tr> <br>");
                    
                   
                
            }
            $('#badge-cart').html(nBadge);
            var numTotal = '$' + getTotal().toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $('#general-total').html("El total de su carrito es "+numTotal);
           
           
            
        }
        else
        {
            $("#alert-cartP").html("No hay productos en el carrito");
            $('#product_container').html("<div class='col-md-12 text-center'>No hay productos en el carrito</div>");
            $("#alert-cartP").css("height","230px");
        }
        
    }

    function productoAgregado(productid)
    {
        var band=false;
        if(Cookies.get("productos")!=null)
        {
            var productosJSON=jQuery.parseJSON(Cookies.get("productos"));
            var i=0;
            for(i;i<productosJSON.length;i++)
            {
                if(productosJSON[i].id==productid)
                {
                    band=true;
                }
            }
        }
        
        return band;
    }

    function getTotal()
    {
        var total=0;
        if(Cookies.get("productos")!=null)
        {
            var productosJSON=jQuery.parseJSON(Cookies.get("productos"));
            var i=0;
            for(i;i<productosJSON.length;i++)
            {
                var pPriceTotal=(productosJSON[i].real_price)*productosJSON[i].qty;
                
                total+=parseInt(pPriceTotal);
            }
        }
        return total;
    }
   

   
});