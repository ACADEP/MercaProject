
  
  <nav class="navbar navbar-light navbar-expand-lg bg-light sticky-top" id="navbar-header">
    
    
    <a class="navbar-brand" href="{{ url('/') }}" id="nav-bar-logo"><img src="/images/logo-home.png" style="float: left; width: 240px; height:80;"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                
              <div class="nav-menu">

                    <li class="nav-item">
                        @include('pages.partials.search_box')
                    
                       
                    </li>
                @php $categories=App\Category::where('parent_id',0)->take(7)->get(); @endphp
                <div id="search_down">
                    <li class="nav-item dropdown" >
                            
                            <a class="nav-link dropdown-toggle hidden-md-down" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Categorías </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <!-- Categorias y subcategorias -->
                                
                                    @foreach($categories as $category)
                                        @if($category->totalSubcategories() >0)
                                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="{{route('productsByCategory',$category)}}">{{$category->category}}</a>
                                            <ul class="dropdown-menu">
                                            @foreach($category->children()->get() as $sub)
                                            <li><a class="dropdown-item" href="{{route('productsByCategory',$sub)}}">{{$sub->category}}</a></li>
                                            @endforeach
                                            </ul>
                                        </li>
                                        @else
                                        <li><a class="dropdown-item" href="{{route('productsByCategory',$category)}}">{{$category->category}}</a></li>
                                        @endif
                                    @endforeach
                                   
                                    <li><a class="dropdown-item" style="color:blue;" href="{{ route('categories.all') }}">Ver mas categorias</a></li>
                                </ul>
                        </li>
                    </div>
                        
                </div>
                &nbsp&nbsp&nbsp
                <div class="nav-menu">
                    <div id="form-search-down">
                        <li class="nav-item">
                            <div id="form-sesion">
                                @if(Auth::check())
                                    <div class="form-inline">
                                        @role('Client')
                                        <a class="header-color" href="{{ url('/customer/profile') }}">Mi Perfil</a>&nbsp | &nbsp
                                        @else
                                        <a class="header-color" href="{{ url('/admin/index') }}">Mi Perfil</a>&nbsp | &nbsp
                                        @endrole
                                        <a class="header-color" href="{{ url('/logout') }}">Salir</a>
                                    </div>
                                    
                                @else  
                                    <a class="header-color" href="{{ url('/login') }}">Inicio de sesión </a>&nbsp &nbsp
                                    <a class="header-color" href="{{ url('/register') }}">Registrarse</a>&nbsp&nbsp
                                @endif
                                <!-- <a href="#" id="cart"><i class="material-icons"> shopping_cart</i><span class="badge">3</span></a> -->
                                
                            </div>
                        </li>
                    @if(Auth::check())
                        @role('Client')
                            @include('partials.shopping-cart-container')
                        @endrole
                    @else
                        @include('partials.shopping-cart-container')
                    @endif
                    <br><br>
                        <li class="nav-item">
                            {{-- <a data-toggle="modal"  data-target="#exampleModalCenter">Búsqueda especial</a> --}}
                            <a data-toggle="modal"  data-target=".bd-example-modal-lg">Búsqueda avanzada</a>
                        </li>
                        &nbsp&nbsp
                        <li class="nav-item">
                            <a class="header-color" href="{{ url('/about') }}">Nosotros</a>
                        </li>
                        &nbsp&nbsp
                        <li class="nav-item">
                            <a class="header-color" href="{{ url('/help') }}">Ayuda</a>
                        </li>
                    </div>
                    
                </div>  

            </ul>

              </div>
    </nav>
    

<!-- Estilos de la plantilla -->
  @section('styles')
  <style>
      #form-search-down li{
           display: inline-block;
       }
       #form-search-down a{
           text-decoration:none;
       }
       #search_down{
           width: 18%;
       }
       
       .badge {
            background-color: #6394F8;
            border-radius: 10px;
            color: white;
            display: inline-block;
            font-size: 10px;
            line-height: 1;
            padding: 2px 7px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

       
       
  </style>
 

  @stop

  

