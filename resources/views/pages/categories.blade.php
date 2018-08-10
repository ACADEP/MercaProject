@extends('app')

@section('content')
<div class="col-md-12">
    <h1 class="text-center">Categorias</h1>
    @foreach($categories as $category)
        <ul>
           <li><a href="#" style="text-decoration: none;">{{ $category->category }}</a></li>
        </ul>

    @endforeach
</div>

@stop