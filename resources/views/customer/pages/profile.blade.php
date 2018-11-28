@extends('customer.dash')

@section('content')

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/customer/profile') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Datos de Cuenta</li>
    </ol>
</nav>        
    
<section class="content-header">
        <h1>
            Datos de Cuenta 
        </h1> 
</section><br>     

<div class="text-center" style="margin-right: 14%; padding-bottom: 20px;">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_address"><i class="fa fa-plus-square" aria-hidden="true"></i> Actualizar</button>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    
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
