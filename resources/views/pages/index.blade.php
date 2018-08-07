@extends('app')

@section('content')




    <!-- @include('pages.partials.side-nav') -->
    @include('pages.partials.carousel')

    <!-- @include('pages.partials.mobile-header') -->

    <!-- Button to toggle side-nav -->
    <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a> -->
    
    <!-- Featured Products section -->
    @include('pages.partials.featured')

    <!-- Oficcials stores section -->
    @include('pages.partials.stores')

    

    <!-- New Products section -->
    @include('pages.partials.new')

    <!-- Buy for brands -->
    @include('pages.partials.brands')



    
    <!-- close wrapper -->



@stop
