@extends('app')

@section('content')
    
    @include('partials.breadcrum')
       
    <div class="col-md-12 row">
               
                <div class="col-md-8 gallery zoom-container">
                    @if ($product->photos->count() == 0)
                        <p>No hay imagenes de este producto.</p><br>
                        <img src="/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image">
                    @else
                        @foreach ($product->photos->slice(0, 8) as $photo)
                            <div class="col-xs-6 col-sm-4 col-md-4 gallery_image text-center" style="float:left;" >
                                <a href="{{$photo->path }}" data-lity>
                                    <img src="{{$photo->thumbnail_path}}"  alt="Photo ID: {{ $photo->id  }}" data-id="{{ $photo->id }}" class="img-thumbnail">
                                </a>
                            </div>
                        @endforeach
                    @endif
                   
                </div>
                
                <div class="col-md-4">
                    <h5 id="Product_Name">{{ $product->product_name }}</h5>
                    <p id="Product_Brand">Marca: {{ $product->brand->brand_name }}</p>
                    <br>
                    @if($product->reduced_price == 0)
                        <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{number_format($product->price, 2)  }}</div>
                        <br>
                    @else
                        <div class="discount light-300 black-text medium-500" id="Product_Reduced-Price"><s>$ {{number_format($product->price, 2)  }}</s></div>
                        <div class="green-text medium-500" id="Product_Reduced-Price">$ {{number_format(( $product->price-$product->reduced_price), 2) }}</div>
                    @endif
                    <hr>

                    @if ($product->product_qty == 0)
                        <h5 class="text-center red-text">Agotado</h5>
                        <p class="text-center"><b>Disponible: {{ $product->product_qty }}</b></p>
                    @else
                            <input type="hidden" name="product" value="{{$product->id}}" />
                           
                            <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                            <input type="hidden" id="qty" value="1"/>
                            <input type="hidden" id="url" value="{{ url('/cart/add') }}">
                            <button class="btn btn-success btn-addcart" value="{{$product->id}}">
                                    <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                            </button>
                            <br><br>

                            <p><b>Disponible: {{ $product->product_qty }}</b></p>
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
                        <a href="{{ route('show.product', $similar->product_name) }}">
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

</div>  <!-- close col-md-12 -->


      

@stop