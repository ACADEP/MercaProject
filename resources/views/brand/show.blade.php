@extends('app')


@section('content')

            <h3 class="text-center">
                @foreach($brands as $brand)
                    {{ $brand->brand_name }}
                @endforeach
            </h3>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ordenar por
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('brand.newest', $brand->id) }}">Mas nuevos</a></li>
                    <li><a href="{{ route('brand.lowest', $brand->id) }}">Precio mas bajo</a></li>
                    <li><a href="{{ route('brand.highest', $brand->id) }}">Precio mas alto</a></li>
                    <li><a href="{{ route('brand.alpha.lowest', $brand->id) }}">Productos A-Z</a></li>
                    <li><a href="{{ route('brand.alpha.highest', $brand->id) }}">Productos Z-A</a></li>
                </ul>
            </div>



            <br>
            <p>{{ $count }} {{ str_plural('product', $count) }}</p>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-12 wow slideInLeft" id="product-sub-container">
                        <div class="col-md-4 text-center hoverable">
                            <a href="{{ route('show.product', $product->product_name) }}">
                            @if ($product->photos->count() === 0)
                                    <img src="{{asset('/images/no-image-found.jpg')}}" alt="No Image Found Tag" id="Product-similar-Image">
                            @else
                                @if ($product->featuredPhoto)
                                    <img src="{{asset($product->featuredPhoto->thumbnail_path)}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="50%" />
                                @elseif(!$product->featuredPhoto)
                                    <img src="{{asset($product->photos->first()->thumbnail_path)}}" alt="Photo" />
                                @else
                                    N/A
                                @endif
                            @endif
                            </a>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('show.product', $product->product_name) }}">
                            <h5 class="center-on-small-only">{{ $product->product_name }}</h5>
                            <h6 class="center-on-small-only">Brand: {{ $product->brand->brand_name }}</h6>
                            <p style="font-size: .9em;">{!! nl2br(str_limit($product->description, $limit = 200, $end = '...')) !!}</p>
                            </a>
                        </div>
                        <div class="col-md-3 text-center">
                            @if($product->reduced_price == 0)
                                $ {{  $product->price }}
                                <br>
                            @else
                                <div class="text-danger list-price"><s>$ {{ $product->price }}</s></div>
                                $ {{ $product->reduced_price }}
                            @endif
                            <br><br><br>
                                <form action="/store/cart/add" method="post" name="add_to_cart">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="product" value="{{$product->id}}" />
                                    <input type="hidden" name="qty" value="1" />
                                    <button class="btn btn-default waves-effect waves-light">Agregar al carrito</button>
                                </form>
                        </div>
                    </div>
                @endforeach
            </div>


       

    

@endsection

@section('footer')

@endsection