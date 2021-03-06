<div class="col-md-12 pt-5" id="breads">
    <h4 class="text-left animated zoomIn" id="title-product">Tiendas<a href="{{ route('all.shops') }}" class="ml-2" style="font-size: 15px;">Ver todas</a></h4>
    
        <div class="text-center" >
            

                <div id="featured-products-sub-container">
                    <div class="row">
                        <!-- Tiendas -->
                        @foreach ($rand_shops as $shops)
                        
                            <div class="col-sm-6 col-md-3 animated zoomIn" >
                                <a href="{{ route('shop', $shops->id) }}" style="text-decoration:none;">
                                    <div class="card  mb-3" style="max-width: 18rem; height: 290px;">
                                        <div class="card-header header-color">{{ $shops->name }}</div>
                                        <div class="card-body text-primary" id="shop-card">
                                            <img class="img-fluid " width="250px" height="250px" src="{{$shops->path}}" alt="First slide" style="vertical-align: bottom !important;">
                                        </div>
                                    </div>
                                </a>
                            </div>
    
                        @endforeach

                    </div>
                </div>
            
        </div>
</div>