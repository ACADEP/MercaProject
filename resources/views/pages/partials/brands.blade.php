<div class="col-md-12" id="brands">
        <div id="brand-caption">
            <div class="animated fadeInDown">
                <h3><strong><span class="color">Comprar por marcas</span></strong></h3>
                @foreach($rand_brands as $rand)
                    <h6 id="random_brands"><a href="{{ url('brand', $rand->id) }}">{{ $rand->brand_name }}</a></h6>
                @endforeach
            </div>
        </div>
</div>