@extends('app')

@section('content')
     
            <h6>
               Resultados para:  <i>{{ $query }}</i>
            </h6><br>
               
                @if (count($search) == 0 || $search==null)
                 <div class="text-center" style="height:300px;"><h1>No hay productos</h1> </div>   
                @elseif (count($search) >= 1)
                    @foreach($search as $query)
                        <div class="col-md-4 wow slideInLeft" id="product-sub-container">
                            <div class="row">
                                <div class="row col-3 col-sm-3 col-md-3 col-lg-3">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart" style="margin-left: 310px;" value="{{$query->id}}">
                                            <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                                        </button>
                                    </span>
                                </div>
                                <div class="row col-9 col-sm-9 col-md-9 col-lg-9  pt-5 text-center hoverable">
                                    <a href="{{ route('show.product', $query->product_name) }}">
                                    @if ($query->photos->count() === 0)
                                            <img src="/images/no-image-found.jpg" alt="No Image Found Tag">
                                    @else
                                        @if ($query->featuredPhoto)
                                            <img src="{{$query->featuredPhoto->thumbnail_path}}" alt="Photo ID: {{ $query->featuredPhoto->id }}" width="100%" />
                                        @elseif(!$query->featuredPhoto)
                                            <img src="{{$query->photos->first()->thumbnail_path}}" alt="Photo" />
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                    </a>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('show.product', $query->product_name) }}">
                                <h5 class="center-on-small-only">{{ $query->product_name }}</h5>
                                <h6 class="center-on-small-only">Marcas: {{ $query->brand->brand_name }}</h6>
                                <p style="font-size: .9em;">{!! nl2br(str_limit($query->description, $limit = 200, $end = '...')) !!}</p>
                                </a>
                            </div>
                            <div class="text-center">
                                @if($query->reduced_price == 0)
                                    $ {{  number_format($query->price, 2) }}
                                    <br>
                                @else
                                    <div class="text-danger list-price"><s style="color: red">$ {{ number_format($query->price, 2) }}<i class="fa fa-tag" aria-hidden="true"></i></s></div>
                                    $ {{ number_format($query->reduced_price, 2) }}
                                @endif
                                    <input type="hidden" id="product_id{{$query->id}}" value="{{$query->id}}"/>
                                    <input type="hidden" id="qty" value="1"/>
                                    <input type="hidden" id="url" value="/cart/add">
                                    
                            </div>
                        </div>
                    @endforeach
                @endif
           
@endsection
