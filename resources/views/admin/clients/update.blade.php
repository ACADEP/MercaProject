@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
           Editar cliente
        </h1> 
</section><br>

<form action="{{ route('clients.update', ["id"=>$customer->id]) }}" method="POST">
    {{csrf_field()}}
    <div class="text-right" style="margin-bottom:5px;">
        <button type="submit" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
    </div>
    
    @include('admin.clients.includes.form', ["data"=>$customer])
</form>


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
    delay:3000
});
</script>
@endif
@if(Session::has("flash"))
<script>
 $.notify({
    // options
    message: '<strong>{{session("flash")}}</strong>' 
},{
    // settings
    type: 'success',
    delay:3000
});
</script>
@endif
@stop
