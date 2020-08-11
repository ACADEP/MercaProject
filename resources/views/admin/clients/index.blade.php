@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Clientes
        </h1> 
</section><br>

<div class="text-right">
<a role="button" class="btn btn-success"  href="{{route('clients.show.create')}}"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar usuario</a>
</div>
<table class="table text-center">
    <thead>
            <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
              
                <th>Nombre de usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr id="r-User{{$client->id}}">
                    <td>{{$client->full_name}}</td>
                    <td>{{$client->telefono}}</td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->user != null ? $client->user->username : "No asignado"}}</td>
                    <td style="display: inline-flex;">
                    <a  class="btn btn-info btn-xs" href="{!!route('clients.show.update', ['id' => $client->id] )!!}" title="Editar">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </a>
                    <form action="{!!route('clients.delete' )!!}" method="post" style="margin-left: 5px;">
                        <input type="hidden" name="id" value="{{$client->id}}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>  
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
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
