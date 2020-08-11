@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Ordenes
        </h1> 
</section><br>
<div id="body-orders-oxxo">
<div class="col-md-6 form-inline">
<form action="{{route('search-orderOxxo')}}" method="get">
    <input type="seacrh" class="form-control" placeholder="Buscar por número de cotización" autocomplete="off" style="width:60%;" name="search" > 
    <button type="sumbit" class="btn btn-primary">Buscar</button>
</form>
<br>
</div>
@if($orders->count()<=0)
 <div class="alert alert-info col-md-12">No hay órdenes</div>
@else

<table class="table text-center">
    <thead>
            <tr>
                <th>Num. Cotización</th>
                <th>Nombre del cliente</th>
                <th>Email</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr id="order{{$order->id}}">
                    <td>{{$order->market_id}}</td>
                    @if($order->sale->client->customer !=null)
                    <td>{{$order->sale->client->customer->nombre.' '.$order->sale->client->customer->apellidos }}</td>
                    @else
                    <td>{{$order->sale->client->username }}</td>
                    @endif
                    <td>{{$order->sale->client->email}}</td>
                    <td>${{number_format($order->sale->total, 2)}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                    @can("acredit_pay")
                        <form style="display:inline;" method="post" action="{{route('accreditedPay')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <button class="btn btn-success btn-xs">Acreditar pago</button>
                        </form>
                    @endcan
                    @can("delete_order")
                        <button class="btn btn-danger btn-xs btn-order-delete" data-toggle="tooltip" value="{{$order->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    @endcan
                    @can("acredit_pay")
                        <button class="btn btn-danger btn-xs btn-receipt" value="{{$order->id}}" data-toggle="modal" data-target="#add-receipt" data-toggle="tooltip" data-placement="top" title="Subir comprobante"><i class="fa fa-upload" aria-hidden="true"></i></button>
                    @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
@endif
</div>

@stop


@section('msg-success')
@if(Session::has("success"))
<script>
 $.notify({
    // options
    message: '<strong>{{session("success")}}</strong>' 
},{
    // settings
    type: 'success',
    delay:7000
});
</script>
@endif
@if(Session::has("fail"))
<script>
 $.notify({
    // options
    message: '<strong>{{session("fail")}}</strong>' 
},{
    // settings
    type: 'danger',
    delay:7000
});
</script>
@endif
@stop

@section('modal-add-receipt')   
    <!-- Modal -->
    <div class="modal fade" id="add-receipt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Subir comprobante</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeReceipt') }}" class="dropzone" id="my-awesome-dropzone">
                        {{ csrf_field() }}
                        <input type="hidden" name="receipt" id="receipt_id">
                    </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-clear" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


<script>
    var product_id;
    $(".btn-receipt").click(function(){
        product_id=$(this).val();
        $("#receipt_id").val(product_id);
    });

    // Dropzone.options.myAwesomeDropzone = {
    //     paramName: "file", // Las facturas se van a usar bajo este nombre de parámetro
    //     maxFilesize: 10, // Tamaño máximo en MB
    //     maxFiles: 1, //Número de archivos a subir
    //     acceptedFiles: ".rar,.pdf,.jpg", //Tipos de archivos aceptados
    //     dictDefaultMessage: 'Arrastra las facturas de la venta o seleccionalas (max:1)',
    // };

    var varDrop = new Dropzone('.dropzone',{
        acceptedFiles: '.rar, .zip, .pdf, .jpg',
        maxFileSize: 5,
        maxFiles: 1,
        paramName: 'file',
        dictDefaultMessage: 'Arrastra el archivo zip o rar con la comprobante de la venta o seleccionala (max:1)',
        dictMaxFilesExceeded: 'Solo se puede subir un archivo a la vez, recarga la pagina para volver a subir',
        dictInvalidFileType: 'Solo se puede subir archivos rar o zip'
    });
    Dropzone.autoDiscover=false;
    
    varDrop.on('error', function(file, res){
        $('.dz-error-message:last > span').text(res.errors.file[0]);
    });
    varDrop.on('success', function(file, res){
        console.log(res);
        $.notify({
            // options
            message: '<strong>'+res+'</strong>' 
        },{
            // settings
            type: 'success',
            delay:7000
        });
    });



</script>

@stop


