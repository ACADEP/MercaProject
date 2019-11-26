@foreach($data as $product)
        <div class="col-md-4 col-lg-3 col-xs-6 col-sm-6  wow animated zoomIn " id="product-sub-container">
        <div class="text-center" style="margin-bottom:10px;"> <span class="badge badge-primary" style="font-size:15px;">{{$product->brand!=null ? $product->brand->brand_name : 'SinMarca'}}</span> </div>
            <div class="row">
                
                <div class="col-md-12 text-center hoverable" style="width:100%;">
                    <a class="link-products" href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                    @if ($product->photos->count() == 0)
                            <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag">
                    @else
                   
                        @if ($product->featuredPhoto)
                            <img src="{{$product->photos()->first()->path}}" onerror="this.onerror=null; this.src='/images/no-image-found.jpg'" class="img-fluid" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="100%" />
                        @elseif(!$product->featuredPhoto)
                            <img src="{{$product->photos()->first()->path}}" onerror="this.onerror=null; this.src='/images/no-image-found.jpg'" class="img-fluid" alt="Photo" />
                        @else
                            N/A
                        @endif
                    @endif
                    </a>
                </div>
            </div>
            <div class="text-center">
                @php
                    $acorName = substr($product->product_name, 0, 25);
                    $acorDesc = substr($product->description, 0, 25);
                @endphp
                <a class="link-products" href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                <h5 class="center-on-small-only">{{ $acorName }}</h5>
                <p style="font-size: .9em;">{{ substr($product->description,0,50) }}</p>
                <p>SKU: {{$product->product_sku}}</p>
                </a>
            </div>
            <div class="text-center">
                @if($product->reduced_price == 0)
                    <i class="fa fa-tag" style="color: green" aria-hidden="true"></i> $ {{ number_format($product->real_price, 2) }}
                    <br>
                @else
                    <div class="text-danger list-price"><s style="color: red">$ {{ number_format($product->price*1.16, 2) }}<i class="fa fa-tag" aria-hidden="true"></i></s></div>
                    <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{ number_format($product->real_price, 2) }}</div>
                @endif
                    <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                    <input type="hidden" id="qty" value="1"/>
                    <input type="hidden" id="url" value="/cart/add">
                    
            </div>
            <div class="col-md-12 text-center" style="width:100%;">
                    <div class="text-center">
                        @if ($product->product_qty > 0)
                            <button class="btn btn-primary btn-sm btn-addcart"  data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                        @else
                            <span class="badge badge-danger">Agotado</span><br>
                        @endif
                        @if(Auth::check())
                            <button  class="btn btn-warning btn-sm btn-favorite"  data-toggle="tooltip" title="Agregar a favoritos"  data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                        @endif
                    </div>
                </div>
        </div>
       
    @endforeach