<!-- Navigation -->
<div class="row" style="height:150px; width: 100%;">
    <nav class="navbar z-depth-2" id="nav-bar-id">
    <div class="container-fluid " style="width: 90%;">
        
        <div class="navbar-header col-md-4">
        
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand waves-effect waves-light" href="{{ url('/') }}" id="nav-bar-logo"><img src="/images/logo-home.jpg" width="150px"></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        
            
        
        <div class="collapse navbar-collapse col-md-4" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left" id="navbar-left">
                <li>
                    <a href="#menu-toggle" class="btn btn-default btn-xs" id="menu-toggle"><i class="fa fa-bars fa-5x" style="font-size: 7px;"></i> Categorias</a>
                </li>
                <li id="search-li">
                    @include('pages.partials.search_box')
                </li>
                
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="nav navbar-nav navbar-right">
                @if (!$signedIn)
                    <li><a href="{{ url('/login') }}" class="btn-flat" id="nav-bar-Login">Inicio de Sesión</a></li>
                    <li><a href="{{ url('/register') }}" class="btn btn-primary waves-effect waves-light">Registrarse</a></li>
                @else
                    <li><a href="{{ route('cart') }}"><i class="material-icons" style="color: black;">shopping_basket</i><span class="badge green">{{ $cart_count }}</span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-sm btn-primary waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ $user->username }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="dropdwon">
                            <li><a href="{{ url('/profile') }}">Perfil</a></li>
                            <li><a href="{{ url('/logout') }}">Salir</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            
        </div>

    </div>
</nav>

</div>