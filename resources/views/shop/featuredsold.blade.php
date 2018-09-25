            @foreach($products as $prod)
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3 animated zoomIn grow card border-primary mb-2 ml-3 pb-4">
                    <div id="product-container">
                        <a href="{{ route('show.product', $prod->product->product_name) }}" style="text-decoration:none;">
                            <div class="row">
                                <div class="row col-4 col-sm-4 col-md-4 col-lg-4 pl-1">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart" style="margin-left: 220px;" value="{{$prod->product->id}}">
                                            <i class="material-icons" style="line-height: 2">add_shopping_cart</i>
                                        </button>
                                    </span>
                                    <script>
                                        $(function () {
                                        $('[data-toggle="tooltip"]').tooltip()
                                        })
                                    </script>
                                </div>
                                <div class="row col-8 col-sm-8 col-md-8 col-lg-8 d-block pt-5 feactured-imagen">
                                    @if ($prod->product->photos->count() == 0)
                                        <img src="/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image" width="90%" height="90%">
                                    @else
                                        @if ($prod->product->featuredPhoto)
                                            <img  src="{{$prod->product->featuredPhoto->thumbnail_path}}" alt="Photo ID: {{ $prod->product->featuredPhoto->id }}" width="90%" height="90%"/><br>
                                            <br><span class=" text-center label label-red" style="margin-left: 4em; color: red">- ${{ number_format($prod->product->reduced_price, 2) }} <i class="fa fa-tag" aria-hidden="true"></i></span> 
                                            
                                        @elseif(!$prod->product->featuredPhoto)
                                            <img  src="{{$prod->product->photos->first()->thumbnail_path}}" alt="Photo" width="90%" height="90%"/>
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div id="featured-product-name-container prod-featured" style="margin-top: 3em;">
                                @php
                                    $acorName = substr($prod->product_name, 0, 25);
                                @endphp
                                <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $acorName }}</h6>
                            </div>
                            <div>
                                <h6 class="center-on-small-only" id="featured-product-name">Código: {{ $prod->product->product_sku }}</h6>
                            </div>
                            <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  number_format($prod->product->price, 2) }}</div>
                        </a>
                    </div>
                    <input type="hidden" id="product_id{{$prod->product->id}}" value="{{$prod->product->id}}"/>
                    <input type="hidden" id="qty" value="1"/>
                    <input type="hidden" id="url" value="/cart/add">
                </div>
            @endforeach
            <div class="row justify-content-center mt-3 pl-5">
                <!--{{ $products->links() }}-->
            </div>
