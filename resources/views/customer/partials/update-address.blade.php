@extends('customer.dash')

@section('content')

<section class="content-header">
        <h1>
            Actualizar dirección<br>
            <small>Dirección: {{ $address->calle }}</small>
        </h1>
</section><br>
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
            @foreach ($errors->all() as $error)
                <li style="list-style-type: none;">{{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('msg'))
    <div class="alert alert-success"> 
        {{ Session::get('msg') }}
    </div>
@endif

@if(session('flash'))
    <div class="alert alert-danger">
        {{session('flash')}}
    </div>
@endif

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <form  action="{{ route('customer.address.update') }}" method="POST">
        {{csrf_field()}}
        <div class="text-right" style="margin-bottom:5px;">
            <button type="submit" class="btn btn-success" style="">Actualizar</button>
            <a type="button" href="{{ route('customer.address') }}" class="btn btn-default" style="margin-right: 1%; margin-left: 1%;">Volver</a>
        </div>
        <input type="hidden" name="product_id" value="{{ $address->id }}">
        <div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                    <label for="mainstreet">Calle principal:</label>
                    <input type="text" id="mainstreet" name="mainstreet" maxLength='100' autocomplete="off" required class="form-control" value="{{ $address->calle }}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                    <label for="streetsecond">Segunda calle:</label>
                    <input type="text" id="streetsecond" name="streetsecond" maxLength='100' autocomplete="off"  class="form-control" value="{{ $address->calle2 }}" placeholder="Opcional">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                    <label for="streetthird">Tercera Calle:</label>
                    <input type="text" id="streetthird" name="streetthird" maxLength='100' autocomplete="off"  class="form-control" value="{{ $address->calle3 }}" placeholder="Opcional">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                    <label for="postalcode">Código postal:</label>
                    <input type="text" id="postalcode" name="postalcode" maxLength='5' minLength='5' autocomplete="off" required class="form-control" value="{{ $address->cp }}">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                    <label for="numinterior">Número interior:</label>
                    <input type="text" id="numinterior" name="numinterior" maxLength='3' autocomplete="off"  class="form-control" value="{{ $address->numInterior }}" placeholder="Opcional">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                    <label for="numexterior">Número exterior:</label>
                    <input type="text" id="numexterior" name="numexterior" maxLength='6' autocomplete="off"  class="form-control" value="{{ $address->numExterior }}" placeholder="Opcional">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                    <label for="city">Ciudad:</label>
                    <input type="text" id="city" name="city" maxLength='100' autocomplete="off" required class="form-control" value="{{ $address->ciudad }}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                    <label for="state">Estado:</label>
                    <input type="text" id="state" name="state" maxLength='100' autocomplete="off" required class="form-control" value="{{ $address->estado }}">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                    <label for="colony">Colonia:</label>
                    <input type="text" id="colony" name="colony" maxLength='100' autocomplete="off" required class="form-control" value="{{ $address->colonia }}">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                    <label for="references">Referencias:</label>
                    <textarea class="form-control" rows="3" id="references" name="references" maxLength='2500' style="resize: none;" placeholder="Opcional">{{ $address->referencias }}</textarea>
            </div>
        </div>    
    </form>
</div>


@endsection 