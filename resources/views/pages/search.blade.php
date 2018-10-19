@extends('app')

@section('content')

            <h4><br>
               Resultados para:  <i>{{ $search_find }}</i>
            </h4><br>
            <div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                @if (count($search) == 0 || $search==null)
                 <div class="text-center" style="height:300px;"><h1>No hay productos</h1> </div>   
                @elseif (count($search) >= 1)
                    @foreach($search as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wow slideInLeft mb-2 ml-3 pt-3 pb-2" id="product-sub-container" style="max-width: 23%;">
                        <div class="text-center"> <span class="badge badge-primary" style="font-size:15px;">{{$product->brand->brand_name}}</span> </div>
                            <div class="row">
                                <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1" style="float: left; height: 80%;">
                                    <span class="d-inline-block" tabindex="0" style="margin-left: 460%;">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart"  data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                                            <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                                        </button>
                                        @if(Auth::check())
                                            <button class="btn btn-danger btn-xs waves-effect waves-light btn-favorite"  data-toggle="tooltip" title="Agregar a favoritos"  data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                            </button>
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-9 col-sm-9 col-md-9 col-lg-9 d-block pt-1 text-center hoverable">
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
                        </div>
                    @endforeach
                @endif
            </div>
@endsection
