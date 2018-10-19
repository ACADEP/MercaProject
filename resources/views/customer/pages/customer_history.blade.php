@extends('customer.dash')

@section('content')
<section class="content-header">
        <h1>
            Mi historial de compras
        </h1>
    </section><br>
   
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
@php $i=1;@endphp
<div class="panel panel-default">
@foreach($sales as $sale)
   
    <div class="panel-heading" role="tab" id="heading{{$i}}">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
           
           <div class="text-left">Fecha:<span class="label label-default">{{$sale->date}}</span></div> <div class="text-right">Pago: <span class="label label-default">{{$sale->status_pago}}</span></div>
        </a>
      </h4>
    </div>
    <div id="collapse{{$i}}" class="{{ $i==1 ? 'panel-collapse collapse in' : 'panel-collapse collapse' }}" role="tabpanel" aria-labelledby="heading{{$i}}">
      <div class="panel-body">
        <div class="text-left" >
            Envío: <span class="label label-primary" id="status_ship">{{$sale->status_envio}}</span>&nbsp <button class="btn btn-primary btn-xs btn-refresh "  data-toggle="tooltip"  data-placement="top" title="Actualizar estado" value="{{ $sale->id }}"><i class="fa fa-refresh" id="refreshing" aria-hidden="true"></i></button> &nbsp
            <form action="/customer/tracking" method="post" style="display: inline;">
                <input type="hidden" name="sale" id="sale" value="{{ $sale->id }}">
                {{ csrf_field()}}
                <button type="submit"class="btn btn-info btn-xs">Ver detalles</button>
            </form> 
        </div>
        <div class="text-right">
            <button class="btn btn-warning btn-sm btn-reclame" data-toggle="modal" value="{{$sale->id}}" data-target="#reclame">Iniciar reclamo</button>
            <form action="/customer/pdf" method="post" style="display: inline;">
                {{ csrf_field()}}
                <input type="hidden"  name="sale" value="{{$sale->id}}">
                <button class="btn btn-danger btn-sm btn-dpdf" type="submit" data-toggle="tooltip"  data-placement="top" title="Descargar recibo"><i class="fa fa-file-pdf-o" aria-hidden="true" ></i></button>
            </form>
            <button class="btn btn-danger btn-sm" data-toggle="tooltip"  data-placement="top" title="Descargar factura"><i class="fa fa-download" aria-hidden="true" ></i></button>
        </div>
            
            <table class="table text-center">
            <thead>
                    <tr>
                        <th></th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio untitario</th>
                        
                    </tr>
            </thead>
            <tbody>
                @foreach($sale->customerHistories()->get() as $history)
                    <tr>
                        <td><img src="{{$history->product->photos()->first()->path}}" style="height:30px"></td>
                        <td>{{$history->product_name}}</td>
                        <td>{{$history->amount}}</td>
                        <td>${{number_format($history->product_price, 2)}}</td>
                    </tr>
                @endforeach
                
            </tbody>
            
            </table>
           <div class="text-right"><h4><strong>Total: <span class="label label-success">${{number_format($sale->total, 2)}}</span></strong></h4></div>
           <div class="text-left col-md-12 form-inline">
            @if($sale->status_reclamo=="Aceptado" || $sale->status_reclamo=="Rechazado")
              <h3>Su reclamo fue: <strong>{{$sale->status_reclamo}}</h3></strong>  Respuesta: {!! $sale->respond_reclame !!} 
            @endif
           
           </div>
<!-- Fin panel body--></div> 
 <!--Fin collapse-->   </div>
 
    @php $i++;@endphp
    
@endforeach
  
 <!--fin group--> </div>
            <div class="text-center" style="position: absolute; bottom: 10px;">
                {{ $sales->links() }}
            </div> 
        
@stop

@section('msg')
@if(Session::has('flash'))
        <script> 
        $.notify({
            // options
            message: '<strong>{{ Session("flash") }}</strong>' 
        },{
            // settings
            type: 'danger',
            delay:3000
        });
        </script>

@endif
<script>
    $(".btn-dpdf").click(function(){
    var notify=$.notify({
            // options
            message: '<strong>Preparando PDF</strong> por favor esperar...',
            showProgressbar: true
        },{
            // settings
            
            type: 'warning',
            delay:3000
        });
       
    });

</script> 
@stop

@section('mostrar-modal')
<script>
    $(".btn-reclame").click(function()
    {
        $("#sale").val($(this).val());
        $("#sale-image").val($(this).val());
    });
</script>
@if($errors->any())
    <script>
        $(function() {
            $('#reclame').modal('show');
        });
    </script>
@endif
@if(Session::has('sale-success'))
<script>
        $(function() {
            $('#add_images').modal('show');
            $("#sale-image").val({{Session('sale-success')}});
        });
</script>
@endif
@stop

@section('modal-reclame')
<div class="modal fade" id="reclame" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Iniciar un reclamo</h1>
      </div>
      <div class="modal-body">
        <form action="{{ route('make-reclame') }}" method="post">
            {{ csrf_field() }}
            <p>Detallar problema:</p>
            <div id="summernote"></div>
            Caracteres restantes:&nbsp;<span id="maxContentPost"></span>
                <textarea name="reclame_text" style="display:none;" id="reclame_text"></textarea>
            <div class="text-center">
                <input type="hidden" id="sale" name="sale">
                <button type="submit" class="btn btn-primary send">Enviar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
        
        
        <script>
            $(document).ready(function() {
                
                $('#summernote').summernote({
                    height: 200,
                    callbacks: {
                        
                        onKeydown: function (e) { 
                        var t = e.currentTarget.innerText; 
                        if (t.trim().length >= 288) {
                            //delete keys, arrow keys, copy, cut
                            if (e.keyCode != 8 && !(e.keyCode >=37 && e.keyCode <=40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey))
                            e.preventDefault(); 
                        } 
                        },
                        onKeyup: function (e) {
                            var t = e.currentTarget.innerText;
                            $('#maxContentPost').text(288 - t.trim().length);
                        },
                        onPaste: function (e) {
                            var t = e.currentTarget.innerText;
                            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                            e.preventDefault();
                            var maxPaste = bufferText.length;
                            if(t.length + bufferText.length > 288){
                                maxPaste = 288 - t.length;
                            }
                            if(maxPaste > 0){
                                document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                            }
                            $('#maxContentPost').text(288 - t.length);
                        }
                        
                    },
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                    ]
                });

                $(".send").click(function(){
                    var markupStr = $('#summernote').summernote('code');
                    $('#reclame_text').val(markupStr);
                });
            });
        </script>
        
        
      </div>
      
    </div>
  </div>
</div>
@stop

@section('add-images')
<div class="modal fade" id="add_images" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Anexar imágenes</h1>
      </div>
      <div class="modal-body">
            <div class="form-group col-md-12">
                <input type="hidden" name="sale" id="sale-image">
                <div class="dropzone"></div>
            </div>
      </div>
      <div class="text-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Enviar</button>
      </div>
      <br>
    </div>
  </div>
</div>

@stop
@section('ajax-refresh')
<script>
    $(".btn-refresh").click(function(){
       $("#refreshing").addClass("glyphicon-refresh-animate");
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

         $.ajax({
                url: "/customer/status",
                method: 'POST',
                data: { sale:  $(this).val()},
                success: function(response){   
                    $("#status_ship").html(response)
                    $("#refreshing").removeClass("glyphicon-refresh-animate");
                },

                error: function(response){
                    alert("Intente de nuevo");
                    $("#refreshing").removeClass("glyphicon-refresh-animate");
                }

         });
    });

</script>
<style>
.glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
</style>

@stop

@section('js-dropzone')
    <script>
         var varDrop = new Dropzone('.dropzone',{
            url: "/addphotoreclame",
            acceptedFiles: 'image/*',
            maxFileSize: 2,
            maxFiles: 5,
            paramName: 'photoProducto',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las imágenes del producto o seleccionalas (max:5)'
            });
            Dropzone.autoDiscover=false;
            
            varDrop.on('error', function(file, res){
                $('.dz-error-message:last > span').text(res.errors.photoProducto[0]);
            });
            varDrop.on('success', function(file, res){
                
                
            });
            varDrop.on("sending", function(file, xhr, formData, gid) {
                formData.append("sale_id", $('#sale-image').val());
                
            });
       
        
    </script>
@stop