@extends('app')

@section('content')
           
<div class="col-md-12 row">

    <div class="col-sm-12 col-md-12 pt-3" >    
        @include('partials.breadcrum')
    </div>
            
    <div class="row">               
            <div class="col-md-8 gallery row">
                @if ($product->photos->count() == 0)
                    <p>No hay imagenes de este producto.</p><br>
                    <img src="/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image">
                @else
                        <div class="col-md-4">
                        @foreach ($product->photos->slice(0, 8) as $photo)
                            
                            <div class="col-xs-6 col-sm-4 col-md-6 gallery_image text-center"  >
                                <a >
                                    <img src="{{$photo->thumbnail_path}}" onerror="this.onerror=null; this.src='/images/no-image-found.jpg'" id="" alt="Photo ID: {{ $photo->id  }}" data-id="{{ $photo->id }}" class="img-thumbnail img-product">
                                </a>
                            </div>
                        @endforeach
                        </div>
                        <div class="col-md-6" >
                        <div id="img-container" class="xzoom-container" >
                            <img class="xzoom" id="main-img"  onerror="this.onerror=null; this.src='/images/no-image-found.jpg'" style="width:100%;" src="{{ $product->photos()->first()->path}}" xoriginal="{{ $product->photos()->first()->path}}" />
                        </div>
                    </div>
                @endif
               
            </div>
            
            <div class="col-md-4">
                <h5 id="Product_Name">{{ $product->product_name }}</h5>
                <p id="Product_Brand">Marca: {{ $product->brand ? $product->brand->brand_name : 'Sin Marca' }}</p>
                <br>
                @if($product->reduced_price == 0)
                <i class="fa fa-tag" style="color: green" aria-hidden="true"></i> $ {{ number_format($product->real_price, 2) }}
                <br>
                @else
                    <div class="text-danger list-price"><s style="color: red">$ {{ number_format($product->price*1.16, 2) }}<i class="fa fa-tag" aria-hidden="true"></i></s></div>
                    <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{ number_format($product->real_price, 2) }}</div>
                @endif
                    
                
               
                @if ($product->product_qty == 0)
                    <h5 class="text-center red-text">Agotado</h5>
                    <p class="text-center"><b>Disponible: {{ $product->product_qty }}</b></p>
                @else
                        <input type="hidden" name="product" value="{{$product->id}}" />
                        
                        <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                        <input type="hidden" id="qty" value="1"/>
                        <input type="hidden" id="url" value="/cart/add">
                        <span class="d-inline-block" tabindex="0" >
                            <button class="btn btn-primary btn-addcart" data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                                    <i class="fa fa-shopping-cart" style="line-height: 2"></i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                            </button>
                            @if(Auth::check())
                            <button class="btn btn-warning waves-effect waves-light btn-favorite" data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                            @endif
                        </span>
                        <br><br>

                    <p id="Product_Brand" >Cantidad: {{ $product->product_qty }}</p>
                    
                    <img src="{{ route('QRCode') }}" width="200" heigth="200">
                        
                        
                @endif

            </div>

        </div>  <!-- close col-md-12 -->

        <!-- Especificacones y descripcion -->
        <div class="row">
            <div  class="col-md-6" >
            <h2>Descripción</h2>
                {!! $product->description !!}
            </div>
            <div  class="col-md-6" >
            <h2>Especificaciones</h2>
                {!! $product->product_spec !!}
            </div>
        </div>
        <br><br>

        <div class="row">

            <h3 class="col-md-12">Productos similares</h3><br>

            @foreach($similar_product->slice(0, 4) as $similar)
                <div class="col-xs-6 col-md-2" id="Similar-Product-Sub-Container" >
                    <a class="link-products" href="{{ route('show.product', $similar->id."-".$similar->product_name) }}">
                        @if ($similar->photos->count() === 0)
                            <p id="Similar-Title">{{ str_limit($similar->product_name, $limit = 28, $end = '...') }}</p>
                            <img src="/images/no-image-found.jpg" alt="Imagen no encontrada" id="Product-similar-Image">
                        @else
                            @if ($similar->featuredPhoto)
                                <p id="Similar-Title">{{ str_limit($similar->product_name, $limit = 28, $end = '...') }}</p>
                                <img src="{{$similar->featuredPhoto->thumbnail_path }}" alt="Photo ID: {{ $similar->featuredPhoto->id }}" id="Product-similar-Image" />
                            @elseif(!$similar->featuredPhoto)
                                <p id="Similar-Title">{{ $similar->product_name }}</p>
                                <img src="{{$similar->photos->first()->thumbnail_path}}" alt="Photo" id="Product-similar-Image" />
                            @else
                                N/A
                            @endif
                        @endif
                    </a>
                </div>
            @endforeach

        </div>
    </div> 
</div>  <!-- close col-md-12 -->

<script>
$(".xzoom").xzoom({
    position: 'right',
    Xoffset: 15
});

$(".img-product").click(function()
{
    
$("#main-img").attr("src", $(this).attr("src"));
$("#main-img").attr("xoriginal", $(this).attr("src"));

});

 


</script>

      

@stop

@section('zoom-images')
<script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
@stop