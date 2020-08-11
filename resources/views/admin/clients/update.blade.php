@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
           Editar cliente
        </h1> 
</section><br>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
            @foreach ($errors->all() as $error)
                <li style="list-style-type: none;">{{ $error }} </li>
            @endforeach
        
        </ul>
    </div>
@endif

<form action="{{ route('clients.update', ["id"=>$customer->id]) }}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$customer->id}}">
    <div class="text-right" style="margin-bottom:5px;">
        <button type="submit" class="btn btn-success">Guardar</button>
        <a type="button" href="{{route('clients.index')}}" class="btn btn-danger">Cerrar</a>
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
