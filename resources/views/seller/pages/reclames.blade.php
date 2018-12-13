@extends('admin.dash')

@section('content')

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/seller/admin') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Historial de Reclamos</li>
    </ol>
</nav>          

<section class="content-header">
        <h1>
            Historial del reclamos
        </h1>   
</section><br>
@if($sales->count()>0)
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
@php $i=1;@endphp
@foreach($sales as $sale)
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading{{$i}}">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
            Por: {{$sale->client->username}} -  Fecha: {{date('d-m-Y', strtotime($sale->date_reclame))}} Hora: {{date('H:i:s', strtotime($sale->date_reclame))}}
        </a>
      </h4>
    </div>
    <div id="collapse{{$i}}" class="{{ $i==1 ? 'panel-collapse collapse in' : 'panel-collapse collapse' }}" role="tabpanel" aria-labelledby="heading{{$i}}">
      <div class="panel-body">
        <div class="text-center">
            <h4><strong> Compra</strong></h4>
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
           <div class="col-md-8 well well-lg">
                <div class="form-inline col-md-12 text-right">
                    <label for="estado">Asignar estatus: </label>
                    <select name="state_reclame" id="estado{{$sale->id}}">
                        <option selected value="Aceptado">Aceptado</option>
                        <option value="Rechazado">Rechazado</option>
                    </select>
                </div> 
                <h4><strong>Descripción:</strong></h4>
                {!! $sale->reclame_text !!}
                <div class="form-inline col-md-12 text-center">
                    <button class="btn btn-primary btn-sm btn-response" value="{{$sale->id}}" data-toggle="modal" data-target="#respond-reclame">Responder</button>
                </div> 
            
            </div>
            <div class="col-md-4 well well-lg">
                <h4><strong>Imágenes anexas:</strong></h4>
                @if($sale->photosReclame()->count()>0)
                @foreach($sale->photosReclame()->get() as $photo)
                    <div class="col-md-6"><img class="img-responsive" src="{{$photo->path}}"></div>
                    
                @endforeach
                @else
                <h4>No hay imágenes</h4>
                @endif
            </div>
           
          
<!-- Fin panel body--></div>

 <!--Fin collapse-->   </div>
 
    @php $i++;@endphp
    
@endforeach

    
    <div class="text-center">
        <!-- links -->
    </div>
@else
    <h4>No hay reclamos pendientes</h4>
@endif

@stop
@section('select-sale')
    <script>
         $(document).ready(function() {
            $(".btn-response").click(function(){
                $("#sale").val($(this).val());
                $("#reclame_state").val($("#estado"+$(this).val()).val());
            });
        });
    </script>
@stop
@section('modal-respond-reclame')
<div class="modal fade" id="respond-reclame" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Responder reclamo</h1>
      </div>
      <div class="modal-body">
        <form action="{{ route('respond-reclame') }}" method="post">
            {{ csrf_field() }}
            <p>Escriba su respuesta aquí:</p>
            <div id="summernote"></div>
            Caracteres restantes: <span id="maxContentPost"></span>
            <textarea name="reclame_text" style="display:none;" id="reclame_text2"></textarea>
            <div class="text-center">
                <input type="hidden" id="sale" name="sale">
                <input type="hidden" id="reclame_state" name="reclame_state">
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
                    $('#reclame_text2').val(markupStr);
                });
            });
        </script>
        
        
      </div>
      
    </div>
  </div>
</div>
@stop