@extends('app')

@section('content')

<div id="shops">
    <h2 class="text-left" id="title-shop"># Tienda oficial</h2>
    <div class="col-12 text-center" >
        <div class="card border-primary mb-3 text-center">
            <img class="d-block w-100" src="{{ asset('/images/Shops/Apple.jpeg') }}" alt="First slide">
        </div>
    </div>

    <div class="row flex-lg-nowrap">
        <div class="col-6 col-md-3" id="filters">
            <div id="tittle-order">Ordenar</div>
            <div class="list-group">
                <ul class="list-group">
                    <li class="list-group-item">Mas vendidos</li>
                    <li class="list-group-item">Menor precio</li>
                    <li class="list-group-item">Mayor precio</li>
                </ul>
            </div>
            <div id="tittle-filters mt-2">Filtros</div>
            <div class="list-group">
                <dl class="list-group">
                    <dt class="filters-item dropdown-item" data-collapse="#brand-body">Marca</dt>
                    <dd class="dropdown-body">
                        <ul>
                            <li class="list-group-item">#</li>
                            <li class="list-group-item">#</li>
                            <li class="list-group-item">#</li>
                        </ul>
                    </dd>
                    <dt class="filters-item dropdown-item" data-collapse="#brand-body">Precio</dt>
                    <dd class="dropdown-body in">
                        <ul>
                            <li class="list-group-item">#</li>
                            <li class="list-group-item">#</li>
                            <li class="list-group-item">#</li>
                        </ul>
                    </dd>
                    <dt class="filters-item dropdown-item" data-collapse="#brand-body">Calificación</dt>
                    <dd class="dropdown-body in">
                        <ul>
                            <li class="list-group-item">*</li>
                            <li class="list-group-item">**</li>
                            <li class="list-group-item">***</li>
                            <li class="list-group-item">****</li>
                            <li class="list-group-item">*****</li>
                        </ul>
                    </dd>
                    <dt class="filters-item dropdown-item" data-collapse="#brand-body">Existencia</dt>
                    <dd class="dropdown-body in">
                        <ul>
                            <li class="list-group-item">20</li>
                            <li class="list-group-item">50</li>
                            <li class="list-group-item">100</li>
                        </ul>
                    </dd>
                    <dt class="filters-item dropdown-item" data-collapse="#brand-body">Populares</dt>
                    <dd class="dropdown-body in">
                        <ul>
                            <li class="list-group-item">#</li>
                            <li class="list-group-item">#</li>
                            <li class="list-group-item">#</li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="row">
            <!-- Tienda -->
            <div class="col-6 col-md-3 text-center">
                <div class="card border-primary mb-3">
                    <div class="card-header">HP</div>
                    <div class="card-body text-primary" id="store-card">
                        <h5 class="card-title">Tienda electronica</h5>
                        <p class="card-text">Esta la tienda oficial de HP</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 text-center">
                <div class="card border-primary mb-3">
                    <div class="card-header">Dell</div>
                    <div class="card-body text-primary" id="store-card">
                        <h5 class="card-title">Tienda electronica</h5>
                        <p class="card-text">Esta la tienda oficial de Dell</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 text-center">
                <div class="card border-primary mb-3">
                    <div class="card-header">Microsoft</div>
                    <div class="card-body text-primary" id="store-card">
                        <h5 class="card-title">Tienda electronica</h5>
                        <p class="card-text">Esta la tienda oficial de Microsoft</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 text-center">
                <div class="card border-primary mb-3">
                    <div class="card-header">Apple</div>
                    <div class="card-body text-primary" id="store-card">
                        <h5 class="card-title">Tienda electronica</h5>
                        <p class="card-text">Esta la tienda oficial de Apple</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
