
<div class="col-md-12" id="new_product">
<h4 class="text-left animated zoomIn" id="title-product">Nuevos productos<a href="{{ route('all.new-products') }}" class="ml-2" style="font-size: 15px;">Ver todos</a></h4>
    <div class="text-center row">
        <div class="container-fluid" id="Index-Main-Container">
            <div id="featured-products-sub-container">
                <div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                    @include('pages.utils.product-card', ["data"=>$new])
                </div>
            </div>  
        </div>
    </div>
</div>



