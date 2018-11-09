<div class="row col-md-12">
    <nav aria-label="breadcrumb" style="width: 100%; max-width: 100%;">
        <ol class="breadcrumb breadcrumb-right-arrow">
            @if ($URL[3] == '/') 
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Inicio</a></li>
            @endif
            @if ($URL[3] == '/cart') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Carrito</a></li>
            @endif
            @if ($URL[2] == '/queries') 
                <li class="breadcrumb-item"><a href="{{  url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Busqueda</a></li>
            @endif
            @if ($URL[0] == '/offers') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Productos Destacados</a></li>
            @endif
            @if ($URL[1] == '/new-products') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Productos Nuevos</a></li>
            @endif
            @if ($URL[5] == '/shop/1') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Mercadata</a></li>
            @endif
            @if ($URL[5] == '/shop/2') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Apple</a></li>
            @endif
            @if ($URL[5] == '/shop/3') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Microsoft</a></li>
            @endif
            @if ($URL[5] == '/shop/4') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Microsistemas Californianos</a></li>
            @endif
            @if ($URL[5] == '/shop/5') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Pc Green</a></li>
            @endif
            @if ($URL[5] == '/shop/6') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Todo Pc</a></li>
            @endif
            @if ($URL[5] == '/shop/7') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Exacto</a></li>
            @endif
            @if ($URL[4] == '/brand/1') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Hp</a></li>
            @endif
            @if ($URL[4] == '/brand/2') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Epson</a></li>
            @endif
            @if ($URL[4] == '/brand/3') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Microsoft</a></li>
            @endif
            @if ($URL[4] == '/brand/4') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Seagate</a></li>
            @endif
            @if ($URL[4] == '/brand/5') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Logitech</a></li>
            @endif
            @if ($URL[4] == '/brand/6') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Samsung</a></li>
            @endif
            @if ($URL[4] == '/brand/7') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Sony</a></li>
            @endif
            @if ($URL[4] == '/brand/8') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Dell</a></li>
            @endif
            @if ($URL[4] == '/brand/9') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Acer</a></li>
            @endif
            @if ($URL[4] == '/brand/10') 
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Kodack</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
        </ol>
    </nav>          
</div>