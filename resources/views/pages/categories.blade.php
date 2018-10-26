@extends('app')

@section('content')
<div class="col-md-12">
    <h1 class="text-center">Categorías</h1>
    @foreach($categoriesall as $category)
        @if($category->totalSubcategories() > 0)
        <ul >
            <li> <a href="#" >{{ $category->category }}</a></li>
           <ul style="text-decoration: none;">
           @foreach($category->children()->get() as $sub)
           <li><a href="#" >{{ $sub->category }}</a></li>
           @endforeach
          
           
           </ul>
        </ul>
        @else
        <ul >
           <li style="text-decoration: none;"><a href="#" >{{ $category->category }}</a></li>
        </ul>
        @endif
        

    @endforeach
</div>

@stop