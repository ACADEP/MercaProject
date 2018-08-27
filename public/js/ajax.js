$(document).ready(function(){
    
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
                $("#subtotal"+i+"").html(qty*productosJson[i].price);
            }
        }
    });
        

    
    //Mostar productos seleccionados previamente
    mostrarElementos();
    $('#tbody').on('click', '.click-delete', function(e){
        e.preventDefault();
        console.log(Cookies.get("productos"));
        var productosJson=jQuery.parseJSON(Cookies.get("productos"));
        productosJson.splice(this.id, 1);
        Cookies.set("productos",productosJson,1);
        console.log(productosJson); 
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
                    
                    if(Cookies.get("productos")!=null)
                    {
                        var productosJSON=jQuery.parseJSON(Cookies.get("productos"));
                        productosCart=productosJSON;
                    }
                    productosCart.push(response.item);
                    
                    
                    Cookies.set("productos",productosCart,1);
                    if(response.user==1)
                    {
                        $('#client_container').append(response.item.product_name+"<br>---------------------<br>");
                        $('.badge').html(response.itemcount);
                    }
                    else
                    {
                        $('#product_container').append(response.item.product_name+"<br>---------------------<br>");
                        $('.badge').html(productosCart.length);
                       
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
            var total=0;
            var productosArray=jQuery.parseJSON(Cookies.get("productos"));
            $("#items-carts").val(JSON.stringify(productosArray));
            var maxElements=parseInt(productosArray.length);
            for(i;i<maxElements;i++)
            {
               
                    nBadge++;
                    var producto=productosArray[i];
                    
                    $('#product_container').append(producto.product_name+"<br>---------------------<br>");
                    
                    //Mostrar los productos en la vista detalles de carrito
                    $('#tbody').append("<tr>");
                    $('#tbody').append("<td>"+producto.product_name+"</td>");
                    $('#tbody').append("<td>"+producto.price+"</td>");
                    var k=0;
                    $('#tbody').append("<td><select class='form-control selectqty' id='selectQty"+i+"'>");
                    for(k;k<producto.product_qty;k++)
                    {
                        $('#selectQty'+i+'').append("<option value='"+(k+1)+"'>"+(k+1)+"</option>");
                    }
                    $('#tbody').append("</select></td>");
                    
                    var qty=parseInt($( '#selectQty'+i+'').val());
                    $('#tbody').append("<td id='subtotal"+i+"'>"+qty*producto.price+"</td>");
                    total+=qty*producto.price;
                    $('#tbody').append("<td><button type='button' class='btn btn-outline-danger btn-sm click-delete' id='"+i+"'>Borrar</button></td>");
                    $('#tbody').append("</tr> <br>");
                    
                   
                
            }
            $('.badge').html(nBadge);
            $('#total-items').html("<strong>Total</strong>: $"+total);
        }
        else
        {
            // $('.badge').html(0);
            // $('#total-items').html("<strong>Total</strong>: $"+0);
        }
        
    }
   

   
});