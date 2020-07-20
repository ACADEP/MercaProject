@extends('customer.dash')

@section('content')

<style>
.dlk-radio input[type="radio"],
.dlk-radio input[type="checkbox"] 
{
	margin-left:-99999px;
	display:none;
}
.dlk-radio input[type="radio"] + .fa ,
.dlk-radio input[type="checkbox"] + .fa {
     opacity:0.15
}
.dlk-radio input[type="radio"]:checked + .fa,
.dlk-radio input[type="checkbox"]:checked + .fa{
    opacity:1
}
</style>

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/customer/profile') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Direcciones</li>
    </ol>
</nav>        

<section class="content-header">
        <h1>
            Direcciones 
        </h1> 
</section><br>     

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right" style="margin-right: 14%; padding-bottom: 20px;">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_address"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row">
    @if($useraddresses != null)
        @php
            $id = 1;
        @endphp
        <!-- <form action="#" method="POST"> -->
            
            @foreach($useraddresses as $address)
            <div class="panel-group col-xs-4 col-sm-4 col-md-4 col-lg-4" id="accordion" style="width: 100%;" role="tablist" aria-multiselectable="true" >
                        <div class="panel panel-default" id="address{{ $address->id }}">
                            <div class="panel-heading" role="tab" id="heading{{ $id }}">
                                <h4 class="panel-title" style="float: left;">
                                    <div class="dlk-radio btn-group" style="margin-bottom: 10px;">
                                        @if($address->activo == 1)
                                            <label class="btn btn-xs btn-success btn-validate">
                                            <input name="choices[1]" class="form-control activo" type="radio" value="{{ $address->id }}" defaultchecked="checked" checked>
                                                <i class="fa fa-check glyphicon glyphicon-ok icon-validate"></i>
                                            </label>
                                        @else
                                            <label class="btn btn-xs btn-success">
                                                <input name="choices[1]" class="form-control btn-click activo" type="radio" value="{{ $address->id }}" defaultchecked="checked">
                                                <i class="fa fa-check glyphicon glyphicon-ok icon-click"></i>
                                            </label>
                                        @endif
                                         
                                    </div>
                                    <a class="collapsed lead" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $id }}" aria-expanded="false" aria-controls="collapse{{ $id }}">
                                        {{ $address->calle  ?  $address->calle.", " : " "}}  
                                        {{ $address->calle2 ? $address->calle2.", " : " " }} 
                                        {{ $address->calle3 ? $address->calle3.", " : " "}} 
                                        Col. {{ $address->colonia }} - Código postal: {{ $address->cp }}
                                    </a>
                                </h4>
                                <div class="form-inline" style="margin-left: 88%;">
                                    <button class="btn btn-danger btn-xs btn-delete-address" data-toggle="tooltip" value="{{ $address->id }}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                                    <a type="button" href="{{ route('customer.address.showUpdate', $address->id) }}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                </div> 
                            </div>
                            <div id="collapse{{ $id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $id }}">
                                <div class="panel-body">
                                    <label class="lead" for="">Calle principal: {{ $address->calle }}</label><br>
                                    <label class="lead" for="">Ciudad: {{ $address->ciudad }}</label><br>
                                    <label class="lead" for="">Estado: {{ $address->estado }}</label><br>
                                    <label class="lead" for="">Colonia: {{ $address->colonia }}</label><br>
                                    <label class="lead" for="">Código postal: {{ $address->cp }}</label><br>
                                    @if(trim($address->calle2)) 
                                        <label class="lead" for="">Segunda callle: {{ $address->calle2 }}</label><br>
                                    @else 
                                        <label class="lead" for="">Segunda callle: Sin especificar.</label><br>
                                    @endif
                                    @if(trim($address->calle3)) 
                                        <label class="lead" for="">Tercera callle: {{ $address->calle3 }}</label><br>
                                    @else 
                                        <label class="lead" for="">Tercera callle: Sin especificar.</label><br>
                                    @endif
                                    @if(trim($address->numInterior)) 
                                        <label class="lead" for="">Número interior: {{ $address->numInterior }}</label><br>
                                    @else 
                                        <label class="lead" for="">Número interior: Sin especificar.</label><br>
                                    @endif
                                    @if(trim($address->numExterior)) 
                                        <label class="lead" for="">Número exterior: {{ $address->numExterior }}</label><br>
                                    @else 
                                        <label class="lead" for="">Número exterior: Sin especificar.</label><br>
                                    @endif
                                    @if(trim($address->numExterior)) 
                                        <label class="lead" for="">Referecias: {{ $address->referencias }}</label>
                                    @else 
                                        <label class="lead" for="">Referecias: Sin especificar.</label><br>
                                    @endif

                                </div>
                                <!-- <div class="form-inline" style="margin-left: 95%;">
                                    <button class="btn btn-danger btn-xs btn-delete" data-toggle="tooltip" value="{{$address->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                                </div>  -->
                            </div>
                        </div>
                        @php
                            $id++;
                        @endphp
            </div>
                @endforeach

        <!-- </form> -->
    @endif
</div>

@endsection

@section('mostrar-modal')
    @if($errors->any())
        <script>
            $(function() {
                $('#add_address').modal('show');
            });
        </script>
    @endif
@endsection

@push('scripts')
<script>

    // $(document).ready(function() {
    //     var direccionActiva = $('input[name="choices[1]"]:checked').val();
    //     $('.activo').click(function(){
    //         direccionActiva = $('input[name="choices[1]"]:checked').val();
    //         console.log(direccionActiva);
    //         console.log('hola');
    //     });
    //     console.log(direccionActiva);
    //     alert(direccionActiva);
    // });
    // $(document).ready(function(){

        

    //     $('.btn-click').click(function(){

    //     var label = $(this).parents('label');


            
    //         while($('.btn-validate').length){
    //             $('.btn-validate').removeClass('btn-success');
    //             $('.btn-validate').addClass('btn-warning');
    //             $('.icon-validate').removeClass('glyphicon-ok');
    //             $('.icon-validate').addClass('glyphicon-remove');
    //             $('.icon-validate').addClass('icon-click');
    //             $('.icon-validate').removeClass('icon-validate');
    //             $('.btn-validate').addClass('btn-click');
    //             $('.btn-validate').removeClass('btn-validate');

    //         }

    //         label.removeClass('glyphicon-remove');
    //         label.addClass('glyphicon-ok');
    //         label.removeClass('btn-warning');
    //         label.addClass('btn-success');
    //         label.addClass('btn-validate');
    //         label.removeClass('btn-click');

    // });
    // });
    
</script> 
@endpush
