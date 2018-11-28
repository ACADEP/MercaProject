
<div class="modal fade" id="add_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Subir factura</h1>
      </div>
      <div class="modal-body">

            <div class="form-group col-md-12">
                <input type="hidden" name="factura" id="factura_id">
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
        var factura;
        $(".btn-invoice").click(function(){
            factura=$(this).val();
            $("#factura_id").val(factura);
           
            
        });

         var varDrop = new Dropzone('.dropzone',{
            url: "/addphoto",
            acceptedFiles: 'image/*, application/pdf',
            maxFileSize: 5,
            maxFiles: 3,
            paramName: 'invoceSale',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las facturas de la venta o seleccionalas (max:3)'
            });
            Dropzone.autoDiscover=false;
            
            varDrop.on('error', function(file, res){
                $('.dz-error-message:last > span').text(res.errors.invoceSale[0]);
            });
            varDrop.on('success', function(file, res){
                if(res.imageUrl!=null && res.url!=null)
                {
                    // $("#images-products").append(
                    // "<form action='"+res.url+"' method='POST'>"+
                    // "<input type='hidden' name='_token' value='{{ csrf_token() }}'>"+
                    // "<input type='hidden' name='_method' value='delete'>"+
                    // "<div class='col-md-4'>"+ 
                    // "<button class='btn btn-danger btn-xs' style='position: absolute;'><i class='fa fa-remove'></i></button>"+
                    // "<img class='img-responsive' src='"+res.imageUrl+"'>"+
                    // "</div>"+
                    // "</form>"

                    );
                }
                else
                {
                    alert("Ya hay un maximo de 3 facturas de esta venta");
                }
                
            });
            varDrop.on("sending", function(file, xhr, formData, gid) {
                formData.append("factura", $('#factura_id').val());
                
            });
       
        
    </script>
@stop