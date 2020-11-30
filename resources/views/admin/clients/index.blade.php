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
                    <td>{{$client->telefono ? $client->telefono : "No ingresado" }}</td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->user != null ? $client->user->username : "No asignado"}}</td>
                    <td>
                    <a  class="btn btn-info btn-xs" href="{!!route('clients.show.update', ['id' => $client->id] )!!}" title="Editar">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </a>
            
                    <button type="button" class="btn btn-danger btn-xs btn-client-delete" value="{{$client->id}}" title="Eliminar">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>  
                   
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
@stop

@push('scripts')
    <script>
        $(".btn-client-delete").click(function(){
           
            if (confirm("¿Desea eliminar a este cliente?")) 
            {
                var id_element=$(this).val();
                $.ajax({method:"post", 
                url: "{{route('clients.delete')}}", data: {_token: "{{ csrf_token() }}", id: id_element},
                
                success: function(result){
                    $.notify({
                        // options
                        message: '<strong>'+result+'</strong>' 
                    },{
                        // settings
                        type: 'success',
                        delay:3000
                    });
                    $("#r-User"+id_element).fadeOut();
                }});
            } 
            
        });
    </script>
@endpush

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
