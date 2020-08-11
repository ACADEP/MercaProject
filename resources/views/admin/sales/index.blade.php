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
                    <td ><img src="{{ $history->product_photo }}" height="30px"></td>
                    <td>{{ $history->product->product_name }}</td>
                    <td>${{number_format($history->total, 2)}}</td>
                    <td>{{ $history->client }}</td>
                    <td>{{ $history->date }}</td>
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
        {{ $sales->appends(Request::input())->links() }}
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
                    @php $sold= App\Sale::find($sale->sale_id);@endphp
                    
                    <div class="panel-heading" role="tab" id="heading{{$i}}">
                        <h4 class="panel-title">
                            <div class="col-sm-10 col-md-10">
                                <a  class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}"> 
                                    <div class="text-left" style="float:left;">Fecha:<span class="label label-default">{{$sold->date}}</span></div>
                                    <div style="float:left; margin-left:5px;" class="form-inline"><span class="label label-primary"> Tipo de pago: {{$sold->pay_method == null ? 'No especificado' :$sold->pay_method}}</span></div>     
                                </a>
                                @if(isset($orderAll))
                                    @if($orderAll==2)
                                    @php 
                                        $seller_id=App\UserSeller::select('seller_id')->where('client_id', $sold->user_id)->first();
                                        $seller_name=null;
                                        if($seller_id!=null)
                                        {
                                            $seller_name=App\User::select('username')->where('id', $seller_id->seller_id)->first();
                                        }

                                    @endphp 
                                    <div style="float:left; margin-left:5px;" class="form-inline"><span class="label label-default"> Vendedor: {{$seller_name == null ? 'No especificado' :$seller_name->username}}</span></div>        
                                    @endif
                                @endif
                            </div>
                           
                            <div class="col-sm-2 col-md-2 text-right">
                            <form action="{{route('salesPdf',$sold->id)}}" style="display:inline;" method="get">
                                <button type="submit" formtarget="_blank" data-placement="top" title="Recibo de pago" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i></button>
                            </form>
                                    <button type="button" class="btn btn-primary btn-xs btn-invoice" value="{{$sold->id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-archive-o" aria-hsale_idden="true" title="Subir Factura"></i></button>
                                    <button class="btn btn-danger btn-xs btn-delete-invoice" data-placement="top" title="Quitar Factura" value="{{$sold->id}}"><i class="fa fa-minus-square"></i></button>        
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
                                    @foreach($sale->where('sale_id',$sale->sale_id)->get(); as $history)
                                        <tr>
                                            <td ><img src="{{ $history->product_photo }}" height="30px"></td>
                                            <td>{{ $history->product_name }}</td>
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
     
        {{ $ventas->appends(Request::input())->links() }}
    </div>
@endif

@stop

@section("msg-success")
@if(Session::has('no-permission'))
<script> 
    $.notify({
        // options
        message: '<strong>{{ Session("no-permission") }}</strong>' 
    },{
        // settings
        type: 'danger',
        delay:5000
    });
    </script>
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

