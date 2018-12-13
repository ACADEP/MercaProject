
<div class="modal fade" id="add_images" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar imagenes</h1>
      </div>
      <div class="modal-body">

            <div class="form-group col-md-12">
                <input type="hidden" name="product_id" id="product_seller_id">
                <div class="dropzone"></div>
            </div>
      </div>
      <div class="text-center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
       
      </div>
      <br>
    </div>
  </div>
</div>

@section('js-dropzone')
    <script>
        var product_id;
        $(".btn-image").click(function(){
            product_id=$(this).val();
            $("#product_seller_id").val(product_id);
           
            
        });

         var varDrop = new Dropzone('.dropzone',{
            url: "/addphoto",
            acceptedFiles: 'image/*',
            maxFileSize: 2,
            maxFiles: 5,
            paramName: 'photoProducto',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las imagenes del producto o seleccionalas (max:5)'
            });
            Dropzone.autoDiscover=false;
            
            varDrop.on('error', function(file, res){
                $('.dz-error-message:last > span').text(res.errors.photoProducto[0]);
            });
            varDrop.on('success', function(file, res){
                if(res.imageUrl!=null && res.url!=null)
                {
                    $("#images-products").append(
                    "<form action='"+res.url+"' method='POST'>"+
                    "<input type='hidden' name='_token' value='{{ csrf_token() }}'>"+
                    "<input type='hidden' name='_method' value='delete'>"+
                    "<div class='col-md-4'>"+ 
                    "<button class='btn btn-danger btn-xs' style='position: absolute;'><i class='fa fa-remove'></i></button>"+
                    "<img class='img-responsive' src='"+res.imageUrl+"'>"+
                    "</div>"+
                    "</form>"

                    );
                }
                else
                {
                    alert("Ya hay un maximo de 5 imagenes de este producto");
                }
                
            });
            varDrop.on("sending", function(file, xhr, formData, gid) {
                formData.append("product_id", $('#product_seller_id').val());
                
            });
       
        
    </script>
@stop