@extends('customer.dash')

@section('content')

<section class="content-header">
        <h1>
            Mis Tarjetas
        </h1>
        
</section><br>
<div class="text-right" style="padding-bottom: 10px;">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_card"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar Tarjeta</button>
</div>
<table class="text-center table col-md-12" style="width:100%;">
    <thead>
        <tr>
            <th>Número de tarjeta</th>
            <th>Nombre de Titular</th>
            <th>Vigencia</th>
            <th>Cvc</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @if($usercards!=null)
            @foreach($usercards as $cards)
            <tr id="card{{ $cards->id }}">
                <td>{{ $cards->numtarjeta }}</td>
                <td>{{ $cards->titular }}</td>
                <td>{{ $cards->vigencia }}</td>
                <td>{{ $cards->cvc }}</td>
                <td>
                    <div class="form-inline">
                        <button class="btn btn-danger btn-xs btn-delete" data-toggle="tooltip" value="{{$cards->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                        <a type="button" href="{{ route('my-update',$cards->id) }}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                    </div>              
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

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
