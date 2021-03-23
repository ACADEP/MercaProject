  <!-- Fourth Step -->
  <div class="row setup-content-2" id="step-4">
    <div class="col-md-12">
    <h3 class="font-weight-bold pl-0 my-4"><strong>Verificar compra</strong></h3>
         <!-- inicio -->
         <div class="card text-center">
            <div class="card-header">
                Método de pago: <div id="pay" style="font-size:15px; display:inline;">Seleccionar un método</div>
            </div>
            <div class="card-body">
                <h5 class="card-title"><strong>Datos de envío</strong></h5>
                <p class="card-text">
                    @if($addresses->count() > 0)
                        @php $address=$addresses->where('activo',1)->first();@endphp
                        @if($address!=null)
                      
                        <h4>Será enviado a:</h4>
                        <input type="hidden" id="address-active" value="{{$address}}">
                        <input type="hidden" id="customer" value="{{ $customer }}">
                        <div class="" style="font-size:15px;" id="address-ship">
                            &nbsp;<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
                            <strong>CP:</strong>{{$address->cp}} <br>
                            <strong>&nbsp;Ciudad:</strong>{{ $address->ciudad }} {{$address->estado}} <br>
                            <strong>&nbsp;Calles:</strong> {{$address->calle}} entre {{ $address->calle2 }} y {{ $address->calle3 }} <br> 
                            <strong>&nbsp;Colonia:</strong> {{ $address->colonia }} <br>
                            <strong>&nbsp;Número exterior:</strong> {{$address->numExterior=="" ? 'No especificado': $address->numExterior}}<br> 
                            <strong>&nbsp;Número interior:</strong> {{$address->numInterior=="" ? 'No especificado': $address->numinterior}} <br>
                            <strong>&nbsp;Referencias: </strong> {{$address->referencias=="" ? 'No especificado': $address->referencias}}
                        </div>
                       
                        @else
                        <div class="alert alert-danger">Agregar una dirección de envío para continuar su proceso de pago</div>
                        @endif
                    @else
                        <div class="alert alert-danger">Agregar una dirección de envío para continuar su proceso de pago</div>
                    @endif
                </p>
                @if($addresses->count() > 0)
                    @if(Auth::user()->customer !=null)
                @if($rates->count() > 0)
                    @if($subtotal<=0)
                        <div class="alert alert-danger">No hay productos en el carrito</div>
                    @else
                        <button class="btn btn-success btn-rounded text-center" id="btn-conf" type="submit">Confirmar pedido</button><br>
                    @endif
                    
                @else
                <div class="alert alert-danger">No hay paqueterías disponibles</div>
                @endif
                @else
                    <div class="alert alert-danger">Agregar sus datos personales para continuar su proceso de pago <br>
                        <a data-toggle="modal" data-target="#add_personal_data" style="color:blue;" id="personalData">Agregar datos</a>
                    </div>

                @endif
                    
                @endif
            </div>
            <div class="card-footer text-muted">
                Paquetería:  <div id="shipment" style="font-size:15px; display:inline;"> Seleccionar un método</div> <input type="hidden" id="carrie_id"> Costo: <div class="ship-rate" style="display:inline;">Acordar con el vendedor</div> 
                <br> Llegada aproximada: 
                <div id="date_aprox" style="display:inline;"> <span class="badge badge-danger">Solo La Paz BCS Gratis</span> </div> 
                <br>
                <strong>Información de contacto</strong> <br>
                Dirección: Ignacio Allende 270 entre Revolución y Serdan, col. Centro, CP: 23000 La Paz, Baja California Sur, México. <br>
                Contacto: sistemas@brokersconnector.com <br>
                <a href="{{route('pages.terms-and-conditions')}}" target="_blanck">Terminos y condiciones</a>
            </div>
        </div>
         <!-- fin -->
         <button class="btn btn-mdb-color btn-rounded prevBtn-2 text-center" type="button">Anterior</button>
            
        

        
    </div>
</div>