@extends('admin.dash')

@section('content')

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/admin/index') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Facturas</li>
    </ol>
</nav>          

<section class="content-header">
        <h1>
            Facturas
        </h1>
        
</section><br>
<div class="text-right">
    <button class="btn btn-success btn-invoice"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar factura</button>
</div>
<br>
<div class="form-group col-md-12">
    <input type="hidden" name="invoice" id="invoice_id">
    <div class="dropzone"></div>
</div>


@stop

@section('js-dropzone')
    <script>
        var invoice;
        $(".btn-invoice").click(function(){
            invoice=$(this).val();
            $("#invoice_id").val(invoice);
           
            
        });

         var varDrop = new Dropzone('.dropzone',{
            url: "/admin/invoice/addInvoice",
            acceptedFiles: 'image/*,application/pdf',
            maxFileSize: 5,
            maxFiles: 2,
            paramName: 'photoProducto',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las facturas o seleccionalas (max:2)'
            });
            Dropzone.autoDiscover=false;
            
            varDrop.on('error', function(file, res){
                $('.dz-error-message:last > span').text(res.errors.photoProducto[0]);
            });
            varDrop.on('success', function(file, res){
                if(res.imageUrl!=null && res.url!=null)
                {
                    $("#images-products").append(
                    "<form action='"+res.url+"' method='POST'>"+
                    "<input type='hidden' name='_token' value='{{ csrf_token() }}'>"+
                    "<input type='hidden' name='_method' value='delete'>"+
                    "<div class='col-md-4'>"+ 
                    "<button class='btn btn-danger btn-xs' style='position: absolute;'><i class='fa fa-remove'></i></button>"+
                    "<img class='img-responsive' src='"+res.imageUrl+"'>"+
                    "</div>"+
                    "</form>"

                    );
                }
                else
                {
                    alert("Ya hay un maximo de 5 imagenes de este producto");
                }
                
            });
            varDrop.on("sending", function(file, xhr, formData, gid) {
                formData.append("invoice", $('#invoice_id').val());
                
            });
       
        
    </script>
@stop