@extends('app')


@section('content')

    <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">

                    <li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Marcas <span class="caret"></span>
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

                    <br><br>

                    @foreach($category as $cat)
                        <li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ $cat->category }} <span class="caret"></span>
                                <ul class="dropdown-menu">
                                    @foreach($cat->children as $children)
                                        <li id="dropdown-category">
                                            <a href="{{ url('category', $children->id) }}">
                                                {{ $children->category }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </a>
                        </li>
                        </li>
                    @endforeach

                    <br><br>

                    <li>
                        <a href="{{ url('admin/dashboard') }}">
                            ADMIN
                        </a>
                    </li>

                </ul>
            </div>
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>


        <div class="container-fluid">

            <h3 class="text-center">
                @foreach($categories as $category)
                    {{ $category->category }}
                @endforeach
            </h3>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sort By
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('category.newest', $category->id) }}">Newest</a></li>
                    <li><a href="{{ route('category.lowest', $category->id) }}">Price Lowest</a></li>
                    <li><a href="{{ route('category.highest', $category->id) }}"> Price Highest</a></li>
                    <li><a href="{{ route('category.alpha.lowest', $category->id) }}">Product A-Z</a></li>
                    <li><a href="{{ route('category.alpha.highest', $category->id) }}">Product Z-A</a></li>
                </ul>
            </div>


            <br>
            <p>{{ $count }} {{ str_plural('product', $count) }}</p>

            <div class="row">
                    @include('pages.utils.product-card', ["data"=>$products])
            </div>

        </div>  <!-- close container-fluid-->

    </div> <!-- close wrapper -->

@endsection

@section('footer')

@endsection