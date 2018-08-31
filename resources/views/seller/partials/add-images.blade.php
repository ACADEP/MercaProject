<div class="modal fade" id="add_images" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar imagenes</h1>
      </div>
      <div class="modal-body">

            <div class="form-group col-md-12">
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
        var url;
        $(".btn-image").click(function(){
            product_id=$(this).val();
            
        });
       
        var varDrop = new Dropzone('.dropzone',{
        url: "/addphoto/"+product_id,
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
            console.log(res);
            $('.dz-error-message:last > span').text(res.errors.photoProducto[0]);
        });
    </script>
@stop