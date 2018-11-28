@extends("admin.dash")

@section("content")

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
                <th>Factura</th>
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
                    <td>
                        <button type="button" class="btn btn-primary btn-xs btn-invoice" value="{{$history->sale_id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Subir Factura"></i></button>
                        <button class="btn btn-danger btn-xs btn-row-market" data-placement="top" title="Quitar Factura" value="{{$history->id}}"><i class="fa fa-minus-square"></i></button>
                    </td>
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
                    <div class="form-group col-md-12">
                        <input type="hidden" name="factura" id="factura_id">
                        <div class="dropzone"></div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


<script>
    var factura;
    $(".btn-invoice").click(function(){
        factura=$(this).val();
        $("#factura_id").val(factura);
    });

        var varDrop = new Dropzone('.dropzone',{
        url: "/admin/sales/addInvoice",
        acceptedFiles: 'image/*, application/pdf',
        maxFileSize: 5,
        maxFiles: 3,
        paramName: 'invoiceSale',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        dictDefaultMessage: 'Arrastra la facturas de la venta o seleccionala'
        });
        Dropzone.autoDiscover=false;
        
        varDrop.on('error', function(file, res){
            $('.dz-error-message:last > span').text(res.errors.invoiceSale[0]);
        });
        varDrop.on('success', function(file, res){
            if(res.imageUrl!=null && res.url!=null)
            {
                // $("#images-products").append(
                // "<form action='"+res.url+"' method='POST'>"+
                // "<input type='hidden' name='_token' value='{{ csrf_token() }}'>"+
                // "<input type='hidden' name='_method' value='delete'>"+
                // "<div class='col-md-4'>"+ 
                // "<button class='btn btn-danger btn-xs' style='position: absolute;'><i class='fa fa-remove'></i></button>"+
                // "<img class='img-responsive' src='"+res.imageUrl+"'>"+
                // "</div>"+
                // "</form>"
                // );
            }
            else
            {
                alert("Ya hay un maximo de 1 factura de esta venta");
            }
            
        });
        varDrop.on("sending", function(file, xhr, formData, gid) {
            formData.append("factura", $('#factura_id').val());
            
        });
</script>

@stop

