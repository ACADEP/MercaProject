@extends('app')

@section('content')

   
    @include('pages.partials.carousel')
    
    <!-- Featured Products section -->
    @include('pages.partials.featured')

    <!-- Selled Products section -->
    @include('pages.partials.selled-products')

    {{-- <!-- Oficcials stores section -->
    @include('pages.partials.stores') --}}

    <!-- New Products section -->
    @include('pages.partials.new')

    <!-- Buy for brands -->
    @include('pages.partials.brands')

    <!-- close wrapper -->

@stop
