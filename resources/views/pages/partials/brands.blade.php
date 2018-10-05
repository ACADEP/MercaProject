<!-- <div class="col-md-12 animated fadeInDown" id="brands">
        <div id="brand-caption">
            <div class="animated fadeInDown">
                <h3>Comprar por marcas</h3>
                @foreach($rand_brands as $rand)
                    <h6 id="random_brands"><a href="{{ url('brand', $rand->id) }}">{{ $rand->brand_name }}</a></h6>
                @endforeach
            </div>
        </div>
</div> -->
<h3>Comprar por marcas</h3>
<a href="{{ route('all.brands') }}">Ver todas</a>
<div id="carouselExampleControls2" class="carousel slide" data-ride="carousel" >
    <div class="carousel-inner">
      

      <div class="carousel-item active animated fadeInLeft">
          <img class="d-block w-100" src="/images/slider/brand-store.jpg" height="300px" alt="First slide">
          <div class="carousel-caption hidden-xs">
            <h1><strong>Comprar por marcas</strong></h1>
            <p class="lead">Compra con las mejores marcas!!</p>
          </div>
      </div>
    
    @foreach($rand_brands as $rand)
    <div class="carousel-item animated fadeInLeft">
        <a href="{{ url('brand', $rand->id) }}">
            <div class="carousel-caption hidden-xs">
                    <h1><strong><span class="color">{{ $rand->brand_name }}</span></strong></h1>
            </div>
            <img class="" src="/images/hp_logo.png" alt="Second slide" height="300px" >
         </a>
    </div>
    @endforeach

      

      

    </div>
  

   

</div>