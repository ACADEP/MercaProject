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
});