$(document).ready(function(){
   

    $('.btn-addcart').click(function(e){
        e.preventDefault(); 
       
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
         
            var productid=$(this).val();
            var url= $('#url').val();
            var formData = { product_id  : $('#product_id'+productid).val(), qty  : $('#qty').val() }
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response){
                    console.log(response);
                    var f = new Date();
                    crearCookie("producto1","uno",f.getTime());
                    $('#product_container').html("<p>"+obtenerCookie("producto1")+"</p>");
               
                },

                error: function(response){
                   console.log(response);
                    
                }
        
            });
        
    });

    function crearCookie(clave, valor, diasexpiracion) {
        var d = new Date();
        d.setTime(d.getTime() + (diasexpiracion*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = clave + "=" + valor + "; " + expires;
    }

    function obtenerCookie(clave) {
        var name = clave + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    }

   
});