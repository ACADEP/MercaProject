@extends('app')

@section('content')
<style>
#categories li
{
    list-style: none;
   
}
#categories a
{
    color:blue;
    font-size:20px;
}
</style>
<div class="row col-md-12" id="categories">
    <h1 class="text-center col-md-12">Categorías</h1>
    @foreach($categoriesall as $category)
        @if($category->totalSubcategories() > 0)
        <div class="col-md-3" style="border: solid 1px black; background-color: rgb(230, 230, 230);">
            <ul >
                <li> <a href="{{route('productsByCategory',$category)}}" >{{ $category->category }}</a></li>
                <ul >
                    @foreach($category->children()->get() as $sub)
                    <li><a href="{{route('productsByCategory',$sub)}}" >{{ $sub->category }}</a></li>
                    @endforeach
                </ul>
            </ul>
        </div>
        @else
        <div class="col-md-3" style="border: solid 1px black; background-color: rgb(230, 230, 230);">
            <ul >
                <li><a href="{{route('productsByCategory',$category)}}" >{{ $category->category }}</a></li>
            </ul>
        </div>
        @endif
        

    @endforeach
</div>

@stop