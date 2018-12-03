@extends("admin.dash")

@section("content")

<style>
div.panel-heading {
    margin-bottom: 20px;
}
</style>

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/admin/index') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ventas</li>
    </ol>
</nav>   

<section class="content-header">
        <h1>
            Ventas
        </h1> 
</section><br>
@include('admin.sales.order-sales')

@if ($ventas == null)    
    <table class="text-center table">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre del producto</th>
                <th>Precio unt</th>
                <th>Cliente</th>
                <th>Fecha de la venta</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @if($sales->count()>0)
            @foreach($sales as $history)
                <tr>
                    <td ><img src="{{ $history->product->photos->first()->path }}" height="30px"></td>
                    <td>{{ $history->product->product_name }}</td>
                    <td>${{number_format($history->product->price, 2)}}</td>
                    <td>{{ $history->client }}</td>
                    <td>{{$history->date}}</td>
                    <td>{{ $history->amount }}</td>
                    <td>${{number_format($history->total, 2)  }}</td>
                </tr>
            @endforeach
        @else
        <tr>
           <td>No hay ventas</td> 
        </tr>
        @endif
        </tbody>
    
    </table>
    <div class="text-center">
        {{ $sales->links() }}
    </div>
@else    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        @php 
            $i=1;
            $tot = 0;
        @endphp
        <div class="panel panel-default">
            @if($ventas->count()>0)
                @foreach ($ventas as $sale)
                    <div class="panel-heading" role="tab" id="heading{{$i}}">
                        <h4 class="panel-title">
                            <div class="col-sm-10 col-md-10">
                                <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}"> 
                                    <div class="text-left">Fecha:<span class="label label-default">{{$sale->date}}</span></div>        
                                </a>            
                            </div>
                            <div class="col-sm-2 col-md-2 text-right">
                                    <button type="button" class="btn btn-primary btn-xs btn-invoice" value="{{$sale->id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Subir Factura"></i></button>
                                    <button class="btn btn-danger btn-xs btn-delete-invoice" data-placement="top" title="Quitar Factura" value="{{$sale->id}}"><i class="fa fa-minus-square"></i></button>        
                            </div>
                        </h4>
                    </div>    
                    <div id="collapse{{$i}}" class="{{ $i==1 ? 'panel-collapse collapse in' : 'panel-collapse collapse' }}" role="tabpanel" aria-labelledby="heading{{$i}}">
                        <div class="panel-body">        
                            <table class="text-center table">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre del producto</th>
                                        <th>Precio unt</th>
                                        <th>Cliente</th>
                                        <th>Fecha de la venta</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sale->sellerHistories as $history)
                                        <tr>
                                            <td ><img src="{{ $history->product->photos->first()->path }}" height="30px"></td>
                                            <td>{{ $history->product->product_name }}</td>
                                            <td>${{number_format($history->product->price, 2)}}</td>
                                            <td>{{ $history->client }}</td>
                                            <td>{{$history->date}}</td>
                                            <td>{{ $history->amount }}</td>
                                            <td>${{number_format($history->total, 2)  }}</td>
                                        </tr>
                                        @php $tot = $tot + $history->total @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-right"><h4><strong>Total: <span class="label label-success">${{number_format($tot, 2)}}</span></strong></h4></div>
                        </div>
                    </div>
                    @php 
                        $i++; 
                        $tot = 0;
                    @endphp    
                @endforeach
            @else
                <tr>
                    <td>No hay ventas</td> 
                </tr>
            @endif
        </div>
    </div>

    <div class="text-center">
        {{ $ventas->links() }}
    </div>
@endif

@stop


@section('upload-invoice')   
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Subir Factura</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add-invoice') }}" class="dropzone" id="my-awesome-dropzone">
                        {{ csrf_field() }}
                        <input type="hidden" name="factura" id="invoice_id">
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
    $(".btn-invoice").click(function(){
        product_id=$(this).val();
        $("#invoice_id").val(product_id);
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
        dictDefaultMessage: 'Arrastra el archivo zip o rar con la factura de la venta o seleccionala (max:1)',
        dictMaxFilesExceeded: 'Solo se puede subir un archivo a la vez, recarga la paguina para volver a subir',
        dictInvalidFileType: 'Solo se puede subir archivos rar o zip'
    });
    Dropzone.autoDiscover=false;
    
    varDrop.on('error', function(file, res){
        $('.dz-error-message:last > span').text(res.errors.file[0]);
    });
    varDrop.on('success', function(file, res){
        // varDrop.removeFile(file);
    });



</script>

@stop

