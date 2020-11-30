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
                    url: "/admin/Order/deleteOrder",
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

  

});