@extends('customer.dash')

@section('content')

<section class="content-header">
        <h1>
            Mis direcciones
        </h1>
        
</section><br>
<div class="text-right" style="padding-bottom: 10px;">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_product"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar Dirección</button>
</div>
<table class="text-center table col-md-12" style="width:100%;">
    <thead>
        <tr>
            <th>Calle</th>
            <th>N° Ext.</th>
            <th>N° Int.</th>
            <th>Entre calles</th>
            <th>Referencias</th>
            <th>Código postal</th>
            <th>Colonia</th>
            <th>Ciudad</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    
</table>

@endsection