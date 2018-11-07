
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="product_featured">
   
    <div class="row col-12 col-sm-12 col-md-12 col-lg-12 mt-3">
        @include('shop.shop-filters')
    </div>

    <style>
        .badge {
            margin-right: .3rem;
        }
        /***** REQUIRED STYLES *****/
        .badge-labeled {
            padding-top: 0;
            padding-bottom: 0;
            padding-right: 0.2rem;
        }
        .badge-labeled i {
            padding: 0.25em  0.3rem;
            cursor: pointer;
            position: relative;
            display: inline-block;
            right: -0.2em;
            border-left: solid 1px rgba(255,255,255,.5);
            border-radius: 0 0.25rem 0.25rem 0;
        }
    </style>

    <div class="pt-3">
        <form id="filter" action="" method="post">
            @if ($brandFilter)
                @foreach ($brandFilter as $brand)
                    <span class="badge badge-primary badge-labeled activo" style="font-size:15px;">{{substr($brand, 3)}}<i class="fa fa-times"></i></span>  
                @endforeach
            @endif
            @if ($catFilter)
                @foreach ($catFilter as $cat)
                    <span class="badge badge-primary badge-labeled" style="font-size:15px;">{{substr($cat, 3)}}<i class="fa fa-times"></i></span>  
                @endforeach
            @endif
            @if ($maxfilter && $minFilter)
                <span class="badge badge-primary badge-labeled" style="font-size:15px;">${{$minFilter}}a ${{$maxfilter}}<i class="fa fa-times"></i></span>
            @else
                @if ($maxfilter)
                    <span class="badge badge-primary badge-labeled" style="font-size:15px;">Hasta ${{$maxfilter}}<i class="fa fa-times"></i></span>  
                @else
                    @if ($minFilter)
                        <span class="badge badge-primary badge-labeled" style="font-size:15px;">Desde ${{$minFilter}}<i class="fa fa-times"></i></span>
                    @endif
                @endif
            @endif

        </form>
    </div>

    <div class="text-center row mt-4">  
        @if($relacion)  
            @include('shop.featuredsold')
        @else                
        @foreach($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wow animated zoomIn  m-2" id="product-sub-container" style="max-width: 23%; border: solid blue 1px;">
        <div class="text-center" style="margin-bottom:10px;"> <span class="badge badge-primary" style="font-size:15px;">{{$product->brand->brand_name}}</span> </div>
            <div class="row">
                
                <div class="col-md-12 text-center hoverable" style="width:100%;">
                    <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                    @if ($product->photos->count() == 0)
                            <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag">
                    @else
                        @if ($product->featuredPhoto)
                            <img src="{{$product->photos()->first()->path}}" class="img-fluid" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="100%" />
                        @elseif(!$product->featuredPhoto)
                            <img src="{{$product->photos()->first()->path}}" class="img-fluid" alt="Photo" />
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
                <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                <h5 class="center-on-small-only">{{ $acorName }}</h5>
                <p style="font-size: .9em;">{!! nl2br(str_limit($product->description, $limit = 200, $end = '...')) !!}</p>
                </a>
            </div>
            <div class="text-center">
                @if($product->reduced_price == 0)
                    <i class="fa fa-tag" style="color: green" aria-hidden="true"></i> $ {{  $product->price }}
                    <br>
                @else
                    <div class="text-danger list-price"><s style="color: red">$ {{ number_format($product->price, 2) }}<i class="fa fa-tag" aria-hidden="true"></i></s></div>
                    <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{ number_format(($product->price-$product->reduced_price), 2) }}</div>
                @endif
                    <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                    <input type="hidden" id="qty" value="1"/>
                    <input type="hidden" id="url" value="/cart/add">
                    
            </div>
            <div class="col-md-12 text-center" style="width:100%;">
                    <div class="text-center">
                        <button class="btn btn-primary btn-sm btn-addcart"  data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                        @if(Auth::check())
                            <button  class="btn btn-danger btn-sm btn-favorite"  data-toggle="tooltip" title="Agregar a favoritos"  data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                        @endif
                    </div>
                </div>
        </div>
       
    @endforeach
        @endif
    </div>
    <div class="row justify-content-center mt-3 pl-5">
        {{ $products->appends(Request::input())->links() }}
    </div>
</div>

<script>
    $(function () {
        $('i').on('click', function(e) {
            var form = document.getElementById("filter");
            var span = form.getElementsByTagName("span");
            for(i = 0; i < span.length; i++) {
                console.log(span[i].innerText);
            }
            $(e.target).closest('span').remove();
        })
        /*$(".dropdown-menu a").click(function () {
            var text_selected = $(this).text();
            $("#order").text(text_selected);
        });
        $(".order").text($orden);*/
    });
</script>

