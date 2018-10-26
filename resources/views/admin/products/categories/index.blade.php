@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Categorías
        </h1> 
</section><br>

<div class="text-right">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_category"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar categoría</button>
</div>
<table class="table text-center">
    <thead>
            <tr>
                <th>Nombre</th>
                <th>Subcategorías</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr id="category{{$category->id}}">
                    <td>{{$category->category}}</td>
                    <td>{{$category->children()->count()}}</td>
                    <td>
                        <div class="form-inline">
                            <button class="btn btn-danger btn-xs btn-delete-category" value="{{$category->id}}" data-toggle="tooltip" value="" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                            <form action="{{url('/admin/products/categories/edit',$category)}}" method="get" style="display:inline;">
                                <button class="btn btn-info btn-xs" type="submit" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                            </form>
                            
                        </div>   
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
@stop

@section('show-modal')
@if($errors->any())
    <script>
        $(function() {
            $('#add_category').modal('show');
        });
    </script>
@endif
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
@stop


@section('modal-add-category')
<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar categoría</h1>
      </div>
      <div class="modal-body">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type: none;">{{ $error }} </li>
                    @endforeach
                
                </ul>
                
            </div>
        @endif

      <form id="form-category" action="{{ route('add-category') }}" method="POST">
            {{csrf_field()}}
            <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Agregar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
           
               
            <label for="category_name">Nombre de la categoría:</label>
            <input type="text" name="category_name" maxLength='75' require autocomplete="off"  class="form-control" value="{{old('category_name')}}">
            <br>
            <label>Número de subcategorías:</label>
            <select name="subcategorias" id="select-subC" class="form-control" style="width: 50%;">
                <option value="-1" selected>Ninguna</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <div id="inputs-subC"></div>  
            
        </form>
       
      </div>
    </div>
  </div>
</div>
@stop