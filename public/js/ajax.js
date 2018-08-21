$(document).ready(function(){
    
    //Mostar productos seleccionados previamente
    var i=1;
    while (Cookies.get("productos"+i)!=null) {
        var producto=jQuery.parseJSON(Cookies.get("productos"+i));
        console.log(producto);
        $('#product_container').append(producto.product_name+"<br>-------------------<br>");
        
        $('#tbody').append("<tr>");
        $('#tbody').append("<td>"+producto.product_name+"</td>");
        $('#tbody').append("<td>"+producto.price+"</td>");
        $('#tbody').append("<td>"+producto.product_qty+"</td>");
        $('#tbody').append("<td>$400</td>");
        $('#tbody').append("<td><a href='#'>Borrar</a></td>");
        $('#tbody').append("</tr> <br>");

        i++;
        $('.badge').html(i-1);
    }

    
    $('.btn-addcart').click(function(e){
        e.preventDefault(); 
       
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
            var numProductos;
            var productid=$(this).val();
            var url= $('#url').val();
            var formData = { product_id  : $('#product_id'+productid).val(), qty  : $('#qty').val() }
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response){
                    console.log(response);
                    if(Cookies.get("numProductos")==null){
                        numProductos=1;
                        
                    }else{
                        numProductos=parseInt(Cookies.get("numProductos"));
                        numProductos=numProductos+1;
                    }
                    Cookies.set("numProductos",numProductos,1);
                    console.log(numProductos);
                    Cookies.set("productos"+numProductos,response,1);
                    $('#product_container').append(response.product_name+"<br>-------------------<br>");
                    $('.badge').html(numProductos);
                    
               
                },

                error: function(response){
                    console.log(response);
                    alert("Intente de nuevo");
                }
        
            });
        
    });

    

   
});