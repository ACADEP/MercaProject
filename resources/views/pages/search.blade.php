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
                            <div class="text-center hoverable">
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
                            <div class="text-center">
                                <a href="{{ route('show.product', $query->product_name) }}">
                                <h5 class="center-on-small-only">{{ $query->product_name }}</h5>
                                <h6 class="center-on-small-only">Marcas: {{ $query->brand->brand_name }}</h6>
                                <p style="font-size: .9em;">{!! nl2br(str_limit($query->description, $limit = 200, $end = '...')) !!}</p>
                                </a>
                            </div>
                            <div class="text-center">
                                @if($query->reduced_price == 0)
                                    <i class="fa fa-tag" style="color: black" aria-hidden="true"></i> $ {{  $query->price }}
                                    <br>
                                @else
                                    <div class="text-danger list-price"><s>$ {{ $query->price }}</s></div>
                                    $ {{ $query->reduced_price }}
                                @endif
                                <br><br><br>
                                    <input type="hidden" id="product_id{{$query->id}}" value="{{$query->id}}"/>
                                    <input type="hidden" id="qty" value="1"/>
                                    <input type="hidden" id="url" value="{{ route('addCart') }}">
                                    <button class="btn btn-default btn-addcart" value="{{$query->id}}"><i class="fa fa-cart" aria-hidden="true"></i>Agregar al carrito</button>
                            </div>
                        </div>
                    @endforeach
                @endif
           
@endsection
