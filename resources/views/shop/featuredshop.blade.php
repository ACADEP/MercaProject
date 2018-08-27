
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="product_featured">
    <h4 class="text-center animated zoomIn" id="title-product">Productos #</h4>
    <div class="text-center row d-flex flex-row-reverse">                     
        @foreach($products as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3 animated zoomIn grow card border-primary mb-2 ml-2 pt-3 pb-2">
                <div id="product-container">
                    <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                        @if ($product->photos->count() == 0)
                            <img src="{{asset('images/no-image-found.jpg')}}" alt="No Image Found Tag" id="Product-similar-Image">
                        @else
                            @if ($product->featuredPhoto)
                                <img  src="{{asset($product->featuredPhoto->thumbnail_path)}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="100px"/><br>
                                <span class="label label-red" style="color: red">- ${{$product->reduced_price}}</span>
                            @elseif(!$product->featuredPhoto)
                                <img  src="{{asset($product->photos->first()->thumbnail_path)}}" alt="Photo" />
                            @else
                                N/A
                            @endif
                        @endif
                            <div id="featured-product-name-container">
                                <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $product->product_name }}</h6>
                            </div>
                            <div>
                                <h6 class="center-on-small-only" id="featured-product-name">Codigo: {{ $product->product_sku }}</h6>
                            </div>
                            <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  $product->price }}</div>
                    </a>
                </div>
                <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                <input type="hidden" id="qty" value="1"/>
                <input type="hidden" id="url" value="{{ route('addCart') }}">
                <div class="col-12 col-sm-12 col-md-12 col-md-offset-3 text-center" style="width: 100%;">
                    <button class="btn btn-default btn-rounded waves-effect waves-light btn-block btn-addcart" value="{{$product->id}}" style="width: 100%; ">
                        <i class="fa fa-cart" aria-hidden="true"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center mt-3">
        {{ $products->links() }}
    </div>
</div>



