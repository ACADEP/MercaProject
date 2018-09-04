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
                var pPriceTotal=(productosJson[i].price-productosJson[i].reduced_price)*qty;
                var num = '$' + pPriceTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $("#subtotal"+i+"").html(num);
                productosJson[i].qty=qty;
                Cookies.set("productos",productosJson,1);
                $("#items-carts").val(JSON.stringify(productosJson));
                var numTotal = '$' + getTotal().toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $('#total-items').html("<strong>Total</strong>: "+numTotal);
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
        $('.badge').html(0);
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
                    console.log(response);
                    console.log(response.item);
                    
                        if(response.user==1)
                        {
                            
                            if(response.itemcount<=5 && response.itemcount>0)
                            {
                    
                                $('#client-container').append(response.item.product_name+"<br>---------------------<br>");
                                $('.badge').html(response.itemcount);
                                var total=parseInt(response.item.total);
                                var num = '$' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                $('#total-items-client').html("<strong>Total</strong>: "+num);
                            
                            }
                            else
                            {
                                if(response.itemcount==0)
                                {
                                    alert("Este producto ya ha sido agregado");
                                }
                                else
                                {
                                    $('#cart-detail').html("Ver todos");
                                    $('.badge').html(response.itemcount);
                                    var total=parseInt(response.item.total);
                                    var num = '$' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                    $('#total-items-client').html("<strong>Total</strong>: "+num);
                                }
                                
                            }
                           
                        }
                        else
                        {
                            if(productoAgregado(response.item.id))
                            {
                                alert("Este producto ya ha sido agregado");
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
                                if(productosCart.length<=5)
                                {
                                    $('#product_container').append(response.item.product_name+"<br>---------------------<br>");
                                }
                                else
                                {
                                    $('#cart-detail').html("Ver todos");
                                }
                                $('.badge').html(productosCart.length);
                                var num = '$' + getTotal().toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                $('#total-items').html("<strong>Total</strong>: "+num);
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
       
        if(Cookies.get("productos")!=null)
        {
            var i=0;
            var nBadge=0;
           
            var productosArray=jQuery.parseJSON(Cookies.get("productos"));
            $("#items-carts").val(JSON.stringify(productosArray));
            var maxElements=parseInt(productosArray.length);
            for(i;i<maxElements;i++)
            {
               
                    nBadge++;
                    var producto=productosArray[i];
                    if(i<=4)
                    {
                        $('#product_container').append(producto.product_name+"<br>---------------------<br>");
                    }
                    else
                    {
                        $('#cart-detail').html("Ver todos");
                    }
                    
                    
                    //Mostrar los productos en la vista detalles de carrito
                    var pPriceTotal=(producto.price-producto.reduced_price);
                    var num = '$' + pPriceTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#tbody').append("<tr>");
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
                  
                    $('#tbody').append("<td><button type='button' class='btn btn-outline-danger btn-sm click-delete'  ><i class='fa fa-trash' aria-hidden='true'></i></button></td>");
                    $('#tbody').append("</tr> <br>");
                    
                   
                
            }
            $('.badge').html(nBadge);
            var numTotal = '$' + getTotal().toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $('#total-items').html("<strong>Total</strong>: "+numTotal);
            $('#general-total').html("El total de su carrito es "+numTotal);
           
           
            
        }
        else
        {
            
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
                var pPriceTotal=(productosJSON[i].price-productosJSON[i].reduced_price)*productosJSON[i].qty;
                
                total+=parseInt(pPriceTotal);
            }
        }
        return total;
    }
   

   
});