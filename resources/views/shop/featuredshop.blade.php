
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
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 animated zoomIn grow card border-primary mb-2 ml-3 pt-3 pb-2" style="max-width: 23%;">
                    <div id="product-container">
                        <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                            <div class="row">
                                <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1" style="float: left; height: 80%;">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito" style="margin-left: 460%;">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart"  value="{{$product->id}}">
                                            <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                                        </button>
                                    </span>
                                    <script>
                                        $(function () {
                                        $('[data-toggle="tooltip"]').tooltip()
                                        })
                                    </script>
                                </div>
                                <div class="row col-9 col-sm-9 col-md-9 col-lg-9 d-block pt-1">
                                    @if ($product->photos->count() == 0)
                                        <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag" width="80%" height="80%">
                                    @else
                                        @if ($product->featuredPhoto)
                                            <img  src="{{$product->featuredPhoto->thumbnail_path}}" class="img-fluid" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="80%" height="80%"/><br>
                                            <br><span class="text-center label label-red" style="margin-left: 20%; color: red"><s style="color: red;">${{ number_format($product->price, 2) }} <i class="fa fa-tag" aria-hidden="true"></i></s></span> 
                                            
                                        @elseif(!$product->featuredPhoto)
                                            <img  src="{{$product->photos->first()->thumbnail_path}}" class="img-fluid" alt="Photo" width="80%" height="80%"/>
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div id="featured-product-name-container prod-featured">
                                @php
                                    $acorName = substr($product->product_name, 0, 25);
                                @endphp
                                <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $acorName }}</h6>
                            </div>
                            <div>
                                <h6 class="center-on-small-only" id="featured-product-name">Código: {{ $product->product_sku }}</h6>
                            </div>
                            <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{  number_format(($product->price-$product->reduced_price), 2) }}</div>
                        </a>
                    </div>
                    <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                    <input type="hidden" id="qty" value="1"/>
                    <input type="hidden" id="url" value="/cart/add">
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

