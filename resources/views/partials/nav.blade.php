
  <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" id="navbar-header">
      
      <a class="navbar-brand" href="{{ url('/') }}" id="nav-bar-logo"><img src="{{asset('images/logo-home.jpg')}}" width="150px"></a>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          
          <a class="nav-link dropdown-toggle hidden-md-down" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categorias
          </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- Categorias y subcategorias -->
               
                @foreach($categories as $categorie)
                  <li><a class="dropdown-item" href="#">{{$categorie}}</a></li>
                @endforeach
                
                <!-- Subcategorias dropdown -->
                <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Categoria 2</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Subcategoria 1</a></li>
                    <li><a class="dropdown-item" href="#">Subcategoria 2</a></li>
                  </ul>
                </li>
                <li><a class="dropdown-item" href="#">Categoria 3</a></li>
                
                <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Categoria 4</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Subcategoria 1</a></li>
                    <li><a class="dropdown-item" href="#">Subcategoria 2</a></li>
                    <li><a class="dropdown-item" href="#">Subcategoria 3</a></li>
                  </ul>
                </li> -->
                <li><a class="dropdown-item" href="#">Ver mas categorias</a></li>
                
                
            </ul>
        </li>
      
      </ul>
      
      
            
              
        

       <!-- Busquedas -->
       @include('pages.partials.search_box')

      <div id="form-sesion">
            
           @if(Auth::check())
              <a href="{{ url('/profile') }}">Perfil &nbsp</a>
              <a href="{{ url('/logout') }}">Salir</a>
          @else  
              <a class="" href="{{ url('/login') }}">Inicio de sesion &nbsp &nbsp</a>
              <a class="" href="{{ url('/register') }}">Registrarse</a>
          @endif
            
            
      </div>
      
        
    </div>
  </nav>

