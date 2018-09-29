@extends('customer.dash')

@section('content')

<section class="content-header">
        <h1>
            Métodos de pago
        </h1>        
</section><br>
<div class="text-center" style="margin-right: 14%; padding-bottom: 20px;">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_card"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    @if($usercards != null)
        @php
            $id = 1;
        @endphp
        <div class="panel-group col-xs-6 col-sm-6 col-md-6 col-lg-6" id="accordion" style="width: 100%;" role="tablist" aria-multiselectable="true" >
        @foreach($usercards as $cards)
                <div class="panel panel-default" id="card{{ $cards->id }}">
                    <div class="panel-heading" role="tab" id="heading{{ $id }}">
                        <h4 class="panel-title" style="float: left;">
                            <a class="collapsed lead" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $id }}" aria-expanded="true" aria-controls="collapse{{ $id }}">
                                @php
                                    $acorcard = substr($cards->numtarjeta, 12, 16);
                                @endphp
                                Tarjeta termina en {{ $acorcard }}
                            </a>
                        </h4>
                        <div class="form-inline" style="margin-left: 95%;">
                            <button class="btn btn-danger btn-xs btn-delete" data-toggle="tooltip" value="{{$cards->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                        </div> 
                    </div>
                    <div id="collapse{{ $id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $id }}">
                        <div class="panel-body">
                            <label class="lead" for="">Tarjeta: {{ $cards->numtarjeta }}</label><br>
                            <label class="lead" for="">Titular: {{ $cards->titular }}</label><br>
                            <label class="lead" for="">Vigencia: {{ $cards->vigencia }}</label><br>
                            <label class="lead" for="">CVC: {{ $cards->cvc }}</label>
                        </div>
                        <!-- <div class="form-inline" style="margin-left: 95%;">
                            <button class="btn btn-danger btn-xs btn-delete" data-toggle="tooltip" value="{{$cards->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                        </div>  -->
                    </div>
                </div>
                @php
                    $id++;
                @endphp
        @endforeach
        </div>
    @endif
</div>

@endsection

@section('mostrar-modal')
    @if($errors->any())
        <script>
            $(function() {
                $('#add_card').modal('show');
            });
        </script>
    @endif
@endsection
