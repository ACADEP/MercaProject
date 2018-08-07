<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" style="font-size: 18px;">
                <!-- Marcas -->
                <li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Marcas 
                        <ul class="dropdown-menu">
                            @foreach($brands as $brand)
                                <li id="dropdown-category">
                                    <a href="{{ url('brand', $brand->id) }}">
                                        {{ $brand->brand_name }}
                                    </a>
                                </li>
                            @endforeach
                           
                        </ul>
                    </a>
                </li>
                </li>
                <br>
                 <!-- Categorias -->
                    <li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Categorias 
                                <ul class="dropdown-menu">
                                   
                                        <li id="dropdown-category">
                                            <a href="#">
                                               Nombre de la categoria 1
                                            </a>
                                        </li>

                                        <li id="dropdown-category">
                                            <a href="#">
                                               Nombre de la categoria 2
                                            </a>
                                        </li>

                                        <li id="dropdown-category">
                                            <a href="#">
                                               Nombre de la categoria 3
                                            </a>
                                        </li>
                                   
                                </ul>
                            </a>
                        </li>
                    </li>
                

                <li>
                    <a href="{{ url('/') }}">
                        Bienvenido
                    </a>
                </li>

            </ul>

        </div>  <!-- close sidebar-wrapper -->