<div class="col-md-12" id="breads">
    <h4 class="text-left animated zoomIn" id="title-product">Tiendas</h4>
    <a href="{{ route('all.shops') }}">Ver todas</a>
        <div class="text-center" >
            

                <div id="featured-products-sub-container">
                    <div class="row">
                        <!-- Tiendas -->
                        @foreach ($rand_shops as $shops)
                        
                            <div class="col-sm-6 col-md-3 animated zoomIn" >
                                <a href="{{ route('shop', $shops->id) }}" style="text-decoration:none;">
                                <div class="card border-primary mb-3" style="max-width: 18rem; height: 200px;">
                                    <div class="card-header header-color">{{ $shops->name }}</div>
                                    <div class="card-body text-primary" id="shop-card">
                                        <img class="img-fluid" src="{{$shops->path}}" alt="First slide" width="100%" height="200">
                                    </div>
                                </div>
                            </div>
    
                        @endforeach

                    </div>
                </div>
            
        </div>
</div>