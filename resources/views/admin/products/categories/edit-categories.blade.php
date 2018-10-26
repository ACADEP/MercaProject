@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
           Editar categorías
        </h1> 
</section><br>

@if ($errors->any())
@section("show-inputs")

<script>showInputs("{{Session('numSubC')}}");</script>
@php Session::forget('numSubC'); Session::forget('subC');@endphp
@stop
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type: none;">{{ $error }} </li>
                    @endforeach
                
                </ul>
                
            </div>
@endif

  <form action="{{ route('edit-category') }}" method="POST">
           
           <div class="col-md-6">
           {{csrf_field()}}
            <input type="hidden" name="category" value="{{$category->id}}">
            <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a type="button" href="{{url('admin/products/categories')}}" class="btn btn-default" data-dismiss="modal">Regresar</a>
            </div>
            <div class="form-group">
                    <label for="category_name">Nombre de la categoría:</label>
                    <input type="text" name="category_name" maxLength='75' require autocomplete="off"  class="form-control" value="{{$category->category}}" style="width:100%;">
                    </div>
                    <br>
                    <div class="form-group" >
                    <label for="sub_name">Subcategorías:</label>
                    @if($category->children()->count()<=0)
                    <br> No exiten subcategorías
                    @else
                    
                        @foreach($category->children()->get() as $sub)
                        <div class="form-inline" id="subc-{{$sub->id}}">
                        <button type="button" class="btn btn-danger btn-xs btn-delete-subc" value="{{$sub->id}}" data-toggle="tooltip" value="" data-placement="top" title="Eliminar esta subcategoría"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                        <input type="text" name="sub_name[]" maxLength='75' require autocomplete="off"  class="form-control" value="{{$sub->category}}" style="width:60%;">
                        </div>
                       
                        <br>
                    
                        @endforeach
                    @endif
                    
                </div>
           </div>

          
           
                
        
    </form>
    <div class="col-md-6">
          
           <form  id="form-category" action="{{ route('add-subcategories') }}" method="post">
           {{csrf_field()}}
           <input type="hidden" name="category" value="{{$category->id}}">
           <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>
                <label>Agregar número de subcategorías:</label>
                <select name="subcategorias" id="select-subC" class="form-control" style="width: 50%;">
                    <option value="-1" selected>Ninguna</option>
                    @php $cont=1; $cSubC=$category->children()->count();@endphp
                    @for($i=$cSubC; $i<5; $i++)
                    <option value="{{$cont}}">{{$cont}}</option>
                    @php $cont++; @endphp
                    @endfor
                </select>
                <div id="inputs-subC"></div>  
           
           </form>
           
    </div>
@stop

@section("msg-success")
@if(Session::has('success'))
<script> 
    $.notify({
        // options
        message: '<strong>{{ Session("success") }}</strong>' 
    },{
        // settings
        type: 'success',
        delay:5000
    });
    </script>
@endif

@stop