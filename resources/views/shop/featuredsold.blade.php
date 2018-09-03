
            @foreach($products as $prod)
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3 animated zoomIn grow card border-primary mb-2 ml-3 pt-3 pb-2">
                    <div id="product-container">
                        <a href="{{ route('show.product', $prod->product->product_name) }}" style="text-decoration:none;">
                            <div class="row">
                                <div class="col-8 col-sm-8 col-md-8 col-lg-8 feactured-imagen" style="float: left;">
                                    @if ($prod->product->photos->count() == 0)
                                        <img src="/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image" width="90%" height="90%">
                                    @else
                                        @if ($prod->product->featuredPhoto)
                                            <img  src="{{$prod->product->featuredPhoto->thumbnail_path}}" alt="Photo ID: {{ $prod->product->featuredPhoto->id }}" width="90%" height="90%"/><br>
                                            <br><span class=" text-center label label-red" style="margin-left: 4em; color: red">- ${{$prod->product->reduced_price}} <i class="fa fa-tag" style="color: black" aria-hidden="true"></i></span> 
                                            
                                        @elseif(!$prod->product->featuredPhoto)
                                            <img  src="{{$prod->product->photos->first()->thumbnail_path}}" alt="Photo" width="90%" height="90%"/>
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4" style="float: left;">
                                    <button class="btn btn-default btn-rounded waves-effect waves-light btn-addcart" value="{{$prod->product->id}}">
                                        <i class="material-icons" style="line-height: 2">add_shopping_cart</i>
                                    </button>
                                </div>
                            </div>
                            <div id="featured-product-name-container prod-featured" style="margin-top: 3em;">
                                @php
                                    $acorName = substr($product->product_name, 0, 25);
                                @endphp
                                <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $acorName }}</h6>
                            </div>
                            <div>
                                <h6 class="center-on-small-only" id="featured-product-name">Código: {{ $prod->product->product_sku }}</h6>
                            </div>
                            <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  $prod->product->price }}</div>
                        </a>
                    </div>
                    <input type="hidden" id="product_id{{$prod->product->id}}" value="{{$prod->product->id}}"/>
                    <input type="hidden" id="qty" value="1"/>
                    <input type="hidden" id="url" value="{{ route('addCart') }}">
                </div>
            @endforeach
            <div class="row justify-content-center mt-3 pl-5">
                <!--{{ $products->links() }}-->
            </div>
