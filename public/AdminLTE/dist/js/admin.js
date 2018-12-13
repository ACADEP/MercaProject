function showInputs(num)
{
    var numC=parseInt(num);
    if(numC != -1)
    {
        
        $("#form-category #inputs-subC").html("");
       for(var i=1;i<=numC;i++)
       {    
        var $input = $("<input  class='form-control' type='text' autocomplete='off'>").attr('name', "subC[]");
        $("#form-category #inputs-subC").append("<label>Nombre de la subcategoría "+i+":</label>");
        $("#form-category #inputs-subC").append($input);
          
       }
    }
    else
    {
        $("#form-category #inputs-subC").html("");
    }
}
$(document).ready(function(){
    $("#select-subC").change(function(){
        if($(this).val() != -1)
        {
            var numC=parseInt($(this).val());
            $("#form-category #inputs-subC").html("");
           for(var i=1;i<=numC;i++)
           {    
            var $input = $("<input  class='form-control' type='text' autocomplete='off'>").attr('name', "subC[]");
            $("#form-category #inputs-subC").append("<label>Nombre de la subcategoría "+i+":</label>");
            $("#form-category #inputs-subC").append($input);
              
           }
        }
        else
        {
            $("#form-category #inputs-subC").html("");
        }
        
    });

    $(".btn-delete-subc").click(function(){
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
            var cat_id=$(this).val();
            var formData = { cat_id:cat_id }
            $.ajax({
                url: "/admin/products/categories/delete-subC",
                method: 'POST',
                data: formData,
                success: function(response){
                   
                    $("#subc-"+cat_id).remove();
                   
                    $.notify({
                        // options
                        message: '<strong>'+response+'</strong>' 
                    },{
                        // settings
                        type: 'success',
                        delay:3000
                    });
                    setTimeout(function(){ location.reload(); }, 1000);
                   
                },

                error: function(response){
                    console.log(response);
                    alert("Intente de nuevo");
                }
        
            });
    });

    $(".btn-delete-category").click(function(){
        if (confirm('Seguro que quiere eliminar esta categoría, se eliminaran todas sus subcategorías')) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
                var cat_id=$(this).val();
                var formData = { cat_id:cat_id }
                $.ajax({
                    url: "/admin/products/deleteCategory",
                    method: 'POST',
                    data: formData,
                    success: function(response){
                       
                        $("#category"+cat_id).remove();
                       
                        $.notify({
                            // options
                            message: '<strong>'+response+'</strong>' 
                        },{
                            // settings
                            type: 'success',
                            delay:3000
                        });
                       
                       
                    },
    
                    error: function(response){
                        console.log(response);
                        alert("Intente de nuevo");
                    }
            
                });
        } else {
           
        } 
    });

    $(".btn-order-delete").click(function(){
        if (confirm('Seguro que quiere eliminar esta orden')) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
                var order_id=$(this).val();
                var formData = { order_id:order_id }
                $.ajax({
                    url: "/admin/OrderOxxo/deleteOrder",
                    method: 'POST',
                    data: formData,
                    success: function(response){
                       
                        $("#order"+order_id).remove();
                        $("#b-order").html(response.num_orders);
                        if(response.num_orders<=0)
                        {
                            $("#body-orders-oxxo").html("<div class='alert alert-info'>No hay ordenes</div>");
                        }
                        
                        
                       
                        $.notify({
                            // options
                            message: '<strong>'+response.msg+'</strong>' 
                        },{
                            // settings
                            type: 'success',
                            delay:3000
                        });
                       
                       
                    },
    
                    error: function(response){
                        console.log(response);
                        alert("Intente de nuevo");
                    }
            
                });
        } else {
           
        } 
    });

    $(".btn-delete-user").click(function(){
        if (confirm('Seguro que quiere eliminar este usuario')) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
                var user_id=$(this).val();
                var formData = { user_id:user_id }
                $.ajax({
                    url: "/admin/users/deleteUser",
                    method: 'POST',
                    data: formData,
                    success: function(response){
                       
                        $("#r-User"+user_id).remove();
                       
                        $.notify({
                            // options
                            message: '<strong>'+response+'</strong>' 
                        },{
                            // settings
                            type: 'success',
                            delay:3000
                        });
                       
                       
                    },
    
                    error: function(response){
                        console.log(response);
                        alert("Intente de nuevo");
                    }
            
                });
        } else {
           
        } 
    });

    $(".btn-delete-role").click(function(){
        if (confirm('Seguro que quiere eliminar este rol')) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
                var role_id=$(this).val();
                var formData = { role_id:role_id }
                $.ajax({
                    url: "/admin/users/RolesPermissions/delete",
                    method: 'POST',
                    data: formData,
                    success: function(response){
                       if(response.msg_type==0)
                       {
                            $.notify({
                                // options
                                message: '<strong>'+response.msg+'</strong>' 
                            },{
                                // settings
                                type: 'danger',
                                delay:3000
                            });
                       }
                       else
                       {
                            $("#r-role"+role_id).remove();
                            $.notify({
                                // options
                                message: '<strong>'+response.msg+'</strong>' 
                            },{
                                // settings
                                type: 'success',
                                delay:3000
                            });
                       }
                       
                       
                       
                    },
    
                    error: function(response){
                        console.log(response);
                        alert("Intente de nuevo");
                    }
            
                });
        } else {
           
        } 
    });

    mostrarElementos();
    $(".btn-add-market").click(function(){
        
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var productosCart=new Array();
            var market_id=$(".marketRate").val(); 
            var product_id=$(this).val();
            var product_qty=$("#qty_product"+product_id).val();
            var formData = { product_id:product_id, product_qty:product_qty, market_id:market_id};
            $.ajax({
                url: "/admin/market_rates/addProduct",
                method: 'POST',
                data: formData,
                success: function(response){

                    Cookies.set("market_id",response.market_id,1);
                    $(".marketRate").val(Cookies.get("market_id"));
                    console.log(response);

                    if(response.detail!=null)
                    {
                       
                        if(Cookies.get("products")!=null)
                        {
                            var productosJSON=jQuery.parseJSON(Cookies.get("products"));
                            productosCart=productosJSON;
                        }
                        productosCart.push(response.detail);
                        var cont=productosCart.length-1;
                        Cookies.set("products",productosCart,1);
                        if(cont==0)
                        {
                            $("#productmarket_content").empty();
                        }
                        $("#productmarket_content").append("<div class='col-md-12' id='product"+response.detail.id+"' style='margin-bottom:25px;'><div class='col-md-3'><img src='"+response.detail.thumbnail+"' style='width:100%;'></div>"+
                        "<div class='col-md-3'>"+response.detail.description+"</div>"+
                        "<div class='col-md-3'>"+response.detail.subtotal+"</div>"+
                        "<div class='col-md-3'> <button class='btn btn-danger btn-xs btn-delete-product' id='"+cont+"' value='"+response.detail.id+"'>Borrar</button> </div></div>");
                    }
                    else
                    {
                        $.notify({
                            // options
                            message: '<strong>Este Producto ya se encuentra en la cotización</strong>' 
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

    $(".btn-row-product").click(function(){
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var detail_id=$(this).val();
        var formData = { detail_id:detail_id};
        $.ajax({
            url: "/admin/market_rates/deleteProductEdit",
            method: 'POST',
            data: formData,
            success: function(response){
                $("#rowProduct" + detail_id).remove();
                $.notify({
                    // options
                    message: '<strong>'+response+'</strong>' 
                },{
                    // settings
                    type: 'success',
                    delay:3000
                });
              
                
               
            },

            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
});

$(".btn-row-market").click(function(){
    if (confirm('Seguro que quiere eliminar esta cotización')) {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var market_id=$(this).val();
    var formData = { market_id:market_id};
    $.ajax({
        url: "/admin/market_rates/deleteMarket_rates",
        method: 'POST',
        data: formData,
        success: function(response){
            $("#rowMarket" + market_id).remove();
            $.notify({
                // options
                message: '<strong>'+response+'</strong>' 
            },{
                // settings
                type: 'success',
                delay:3000
            });
          
            
           
        },

        error: function(response){
            console.log(response);
            alert("Intente de nuevo");
        }

    });
    }else{}
});

$("#btn-send-market").click(function(){
    if (confirm('Desea enviar esta cotizacion')) {
        if($("#company").val()=="")
        {
            $.notify({
                // options
                message: '<strong>Ingresar el nombre de la empresa</strong>' 
            },{
                // settings
                type: 'danger',
                delay:3000
            });
        }else if($("#email").val()=="")
        {
            $.notify({
                // options
                message: '<strong>Ingresar un correo valido</strong>' 
            },{
                // settings
                type: 'danger',
                delay:3000
            });

        } else if($(".marketRate").val()=="")
        {
            $.notify({
                // options
                message: '<strong>Ingresar productos</strong>' 
            },{
                // settings
                type: 'danger',
                delay:3000
            });

        }else
        {
            $("#companySend").val($("#company").val());
            $("#emailSend").val($("#email").val());
            $("#form-send").submit();
        }      

        
    }else{}
});

    

    $('#productmarket_content').on('click', '.btn-delete-product', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var detail_id=$(this).val();
        var col_id=this.id;
        var formData = { detail_id  : detail_id};
        $.ajax({
            url: '/admin/market_rates/deleteProduct',
            method: 'POST',
            data: formData,
            success: function(response){

                $("#product" + detail_id).remove();
                var productosJson=jQuery.parseJSON(Cookies.get("products"));
                productosJson.splice(col_id, 1);
                Cookies.set("products",productosJson,1);
                mostrarElementos();

                $.notify({
                    // options
                    message: '<strong>'+response+'</strong>' 
                },{
                    // settings
                    type: 'success',
                    delay:3000
                });

            },

            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
       
    });

    $(".btn-row-brand").click(function(){
        if (confirm('Seguro que quiere eliminar esta marca')) {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var brand_id=$(this).val();
        var formData = { brand_id:brand_id};
        $.ajax({
            url: "/admin/brands/delete-brand",
            method: 'POST',
            data: formData,
            success: function(response){
                $("#rowBrand" + brand_id).remove();
                $.notify({
                    // options
                    message: '<strong>'+response+'</strong>' 
                },{
                    // settings
                    type: 'success',
                    delay:3000
                });
              
                
               
            },
    
            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
        }else{}
    });

    $(".btn-delete-product").click(function(){
        if (confirm('Seguro que quiere eliminar este producto')) {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var product_id=$(this).val();
        var formData = { product_id:product_id};
        $.ajax({
            url: "/admin/products/products/delete",
            method: 'POST',
            data: formData,
            success: function(response){
                $("#rowProduct" + product_id).remove();
                $.notify({
                    // options
                    message: '<strong>'+response+'</strong>' 
                },{
                    // settings
                    type: 'success',
                    delay:3000
                });
              
                
               
            },
    
            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }
    
        });
        }else{}
    });
    function mostrarElementos()
    {
        // Cookies.remove("products");
        // Cookies.remove("market_id");
        $("#productmarket_content").empty();
        if(Cookies.get("market_id")!=null)
        {
            $(".marketRate").val(Cookies.get("market_id"));
        }
        if(Cookies.get("products")!=null)
        {
            var productosArray=jQuery.parseJSON(Cookies.get("products"));
            var cont=productosArray.length;
            if(cont>0){
                var maxElements=parseInt(productosArray.length);
                for(var i=0;i<maxElements;i++)
                {
                    $("#productmarket_content").append("<div class='col-md-12' id='product"+productosArray[i].id+"' style='margin-bottom:25px;'><div class='col-md-3'><img src='"+productosArray[i].thumbnail+"' style='width:100%;'></div>"+
                    "<div class='col-md-3'>"+productosArray[i].description+"</div>"+
                    "<div class='col-md-3'>"+productosArray[i].subtotal+"</div>"+
                    "<div class='col-md-3'> <button class='btn btn-danger btn-xs btn-delete-product' id='"+i+"' value='"+productosArray[i].id+"'>Borrar</button> </div></div>");
                }
            }
            else
            {
                $("#productmarket_content").html("<span class='help-block'>Agregar productos</span>");
            }
        }
        else
        {
            $("#productmarket_content").html("<span class='help-block'>Agregar productos</span>");
        }
    }

});