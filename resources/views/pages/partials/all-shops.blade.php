@extends('app')

@section('content')

<nav aria-label="breadcrumb" class="pt-2">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tiendas</li>
    </ol>
</nav>

<h1 class="shops text-center mt-3 mb-3">Tiendas Oficiales</h1>
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="shops">
 
    <div class="row text-center" >
        <div>
            <div class="row">
                @foreach ($shops as $shop)

                    <div class="col-sm-6 col-md-3 animated zoomIn" >
                        <a href="{{ route('shop', $shop->id) }}" style="text-decoration:none;">
                        <div class="card  mb-3" style="max-width: 18rem; height: 200px;">
                            <div class="card-header header-color">{{ $shop->name }}</div>
                            <div class="card-body text-primary" id="shops-card">
                                <img class="img-fluid" src="{{$shop->path}}" alt="First slide" width="100%" height="200">
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="row justify-content-center mt-3 pl-5">
                {{ $shops->links() }}
            </div>             
        </div>
    </div>

</div>

@endsection