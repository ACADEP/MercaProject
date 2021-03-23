  <!-- First Step -->
    <!-- <form role="form" action="" method="post"> -->
        <div class="row setup-content-2" id="step-1">
            <div class="col-md-12">
           
            <h3 class="font-weight-bold pl-0 my-4"><strong>Dirección</strong></h3>
            @php $i=1;@endphp
                @if($addresses->count() > 0)
                    
                        <div class="text-right">
                            
                            @if($addresses->count() < 3 )
                                &nbsp;&nbsp;
                                <a data-toggle="modal" data-target="#add_address" style="color:blue;">Agregar una dirección</a>
                            @endif
                        </div>
                        
                    <h4>Será enviado a:</h4>
                    @if($addressActive)
                    
                        <div class="border" style="font-size:15px;">
                        <div style="margin-top: 10px; margin-left: 5px;">
                            <a href="/customer/personal/address" style="color:blue;">Cambiar direccion</a> 
                        </div>
                        <hr>
                        &nbsp;<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
                        <strong>CP:</strong>{{$addressActive->cp}} <br>
                        <strong>&nbsp;Ciudad:</strong>{{ $addressActive->ciudad }} {{$addressActive->estado}} <br>
                        <strong>&nbsp;Calles:</strong> {{$addressActive->calle}} entre {{ $addressActive->calle2 }} y {{ $addressActive->calle3 }} <br> 
                        <strong>&nbsp;Colonia:</strong> {{ $addressActive->colonia }} <br>
                        <strong>&nbsp;Número exterior:</strong> {{$addressActive->numExterior=="" ? 'No especificado': $addressActive->numExterior}}<br> 
                        <strong>&nbsp;Número interior:</strong> {{$addressActive->numInterior=="" ? 'No especificado': $addressActive->numinterior}} <br>
                        <strong>&nbsp;Referencias: </strong> {{$addressActive->referencias=="" ? 'No especificado': $addressActive->referencias}}
                        </div>
                   
                        <br>

                    @endif
                    
                @else
                    <a href="{{ url('/customer/personal/address/') }}" style="color: blue;">Agregar una dirección</a>
                    <div class="alert alert-danger">Agregar una dirección de envío para continuar su proceso de pago</div>
                    
                @endif
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" type="button">Siguiente</button>
            </div>
        </div>