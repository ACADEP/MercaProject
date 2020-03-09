

<h3>Comprar por marcas<a href="{{ route('all.brands') }}" class="ml-2" style="font-size: 15px;">Ver todas</a></h3>

<div class="container text-center my-3">
    <div id="recipeCarousel" class="carousel my-carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
            <div class="carousel-item row no-gutters active">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[$i]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[$i]->path}}"></a></div>
                @endfor
            </div>    
            <div class="carousel-item row no-gutters">
                @for ($i = 4; $i < 8; $i++)
                    <div class="col-3 float-left"><a href="{{ url('brand', $rand_brands[$i]->id) }}"><img width="270px" height="270px" src="{{$rand_brands[$i]->path}}"></a></div>
                @endfor
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

