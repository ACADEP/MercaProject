

<h3>Comprar por marcas<a href="{{ route('all.brands') }}" class="ml-2" style="font-size: 15px;">Ver todas</a></h3>

<div class="container text-center my-3">
    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
            <div class="carousel-item row no-gutters active">
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[0]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[0]->path}}"></a></div>
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[1]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[1]->path}}"></a></div>
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[2]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[2]->path}}"></a></div>
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[3]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[3]->path}}"></a></div>
            </div>    
            <div class="carousel-item row no-gutters">
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[4]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[4]->path}}"></a></div>
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[5]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[5]->path}}"></a></div>
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[6]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[6]->path}}"></a></div>
                <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[7]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[7]->path}}"></a></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>
