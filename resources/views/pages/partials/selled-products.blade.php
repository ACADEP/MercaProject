
<div class="col-12 col-sm-12 col-md-12 col-lg-12 pt-5" id="product-selled">
    <h4 class="text-left animated zoomIn" id="title-product">Productos mas Vendidos<a href="{{ route('all.selled') }}" class="ml-2" style="font-size: 15px;">Ver todos</a></h4>
    <div class="text-center row mt-3">                     
        <div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
            @include('pages.utils.product-card', ["data"=>$selledProducts])
        </div>
    </div>
</div>



