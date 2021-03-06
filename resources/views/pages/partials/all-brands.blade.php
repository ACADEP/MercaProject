@extends('app')

@section('content')

<nav aria-label="breadcrumb" class="pt-2">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Marcas</li>
    </ol>
</nav>

<h1 class="brands text-center mt-3 mb-3">Marcas Oficiales</h1>
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="brands">
 
    <div class="row text-center" >
            <div class="row">
                @foreach ($brands as $brand)

                    <div class="col-sm-6 col-md-3 animated zoomIn">
                        <a href="{{ route('brand', $brand->id) }}" style="text-decoration:none;">
                            <div class="card mb-3" style="max-width: 18rem; height: 290px;">
                                <div class="card-header header-color">{{ $brand->brand_name }}</div>
                                <div class="card-body text-primary" id="brand-card">
                                    <img class="img-fluid" width="250px" height="250px" src="{{$brand->path}}" alt="First slide" width="100%" height="200">
                                </div>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
            <div class="row justify-content-center mt-3 pl-5">
                {{ $brands->links() }}
            </div>             
    </div>

</div>

@endsection