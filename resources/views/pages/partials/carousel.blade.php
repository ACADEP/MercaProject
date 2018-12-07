<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 300px;">
    <div class="carousel-inner">
      
      <div class="carousel-item  active animated fadeInDown">
        
          <img class="d-block w-100" style="height:300px;"src="{{config('configurations.general.carrusel_1')}}" alt="First slide">
          <div class="carousel-caption hidden-xs">
            <h1><strong><span class="color">{{config('configurations.general.store_name')}}</span></strong></h1>
            <p class="lead">{{config('configurations.general.carrusel_slogan')}}</p>
          </div>
      </div>

      <div class="carousel-item animated fadeInDown">
        <img class="d-block w-100" style="height:300px;" src="{{config('configurations.general.carrusel_2')}}" alt="Second slide">
      </div>

      <div class="carousel-item animated fadeInDown">
        <img class="d-block w-100" style="height:300px;" src="{{config('configurations.general.carrusel_3')}}" alt="Third slide">
      </div>

    </div>
  

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

</div>