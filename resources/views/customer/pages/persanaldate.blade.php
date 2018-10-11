@extends('customer.dash')

@section('content')

<section class="content-header">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1>
            Datos Personales 
        </h1> 
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1>
            Dirección de Facturación 
        </h1> 
    </div>    
</section><br>     
<div class="text-center" style="margin-right: 90%; padding-bottom: 20px;">
    @if ($userpersonal != null)
        <a type="button" href="{{ route('customer.personal.showUpdate', $userpersonal->id) }}" class="btn btn-success add" ><i class="fa fa-plus-square" aria-hidden="true"></i> Actualizar</a>
    @else
        <button class="btn btn-success add"  data-toggle="modal" data-target="#add_personaldate"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
    @endif
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    @if($userpersonal != null) 
        <label class="lead" for="">Nombre: {{ $userpersonal->nombre }}</label><br>
        <label class="lead" for="">Apellidos: {{ $userpersonal->apellidos }}</label><br>
        <label class="lead" for="">Telefono: {{ $userpersonal->telefono }}</label><br>
    @else 
        <label class="lead" for="">Nombre: </label><br>
        <label class="lead" for="">Apellidos: </label><br>
        <label class="lead" for="">Telefono: </label><br>
    @endif
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    @if($userpersonal != null) 
        <label class="lead" for="">Nombre o razón social: {{ $userpersonal->razonSocial }}</label><br>
        <label class="lead" for="">Tipo de facturación: {{ $userpersonal->tipoFacturacion }}</label><br>
        <label class="lead" for="">RFC: {{ $userpersonal->rfc }}</label><br>
        <label class="lead" for="">Calle: {{ $userpersonal->calle }}</label><br>
        <label class="lead" for="">N° Exterior: {{ $userpersonal->numExterior }}</label><br>
        <label class="lead" for="">N° Interior: {{ $userpersonal->numInterior }}</label><br>
        <label class="lead" for="">Código Postal: {{ $userpersonal->cp }}</label><br>
        <label class="lead" for="">Estado: {{ $userpersonal->estado }}</label><br>
        <label class="lead" for="">Ciudad: {{ $userpersonal->ciudad }}</label><br>
        <label class="lead" for="">Colonia: {{ $userpersonal->colonia }}</label><br>
        <label class="lead" for="">Razón CFDI: {{ $userpersonal->cfdi }}</label><br>
    @else 
        <label class="lead" for="">Nombre o razón social: </label><br>
        <label class="lead" for="">Tipo de facturación: </label><br>
        <label class="lead" for="">RFC: </label><br>
        <label class="lead" for="">Calle: </label><br>
        <label class="lead" for="">N° Exterior: </label><br>
        <label class="lead" for="">N° Interior: </label><br>
        <label class="lead" for="">Código Postal: </label><br>
        <label class="lead" for="">Estado: </label><br>
        <label class="lead" for="">Ciudad: </label><br>
        <label class="lead" for="">Colonia: </label><br>
        <label class="lead" for="">Razón CFDI: </label><br>
    @endif
</div>

@endsection

@section('mostrar-modal')
    @if($errors->any())
        <script>
            $('.add').click(function(){
            // $(function() {
                $('#add_personaldate').modal('show');
            });
            $('.update').click(function(){
                $('#update_personaldate').modal('show');
            });
        </script>
    @endif
@endsection