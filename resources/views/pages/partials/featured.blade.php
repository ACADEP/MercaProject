
<div class="col-12 col-sm-12 col-md-12 col-lg-12" id="product_featured">
    <h4 class="text-left animated zoomIn" id="title-product">Productos en Oferta<a href="{{ route('all.offers') }}" class="ml-2" style="font-size: 15px;">Ver todos</a></h4>

    <div class="text-center row mt-3">                     
        <div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                @include('pages.utils.product-card', ["data"=>$products])
        </div>
    </div>
</div>



