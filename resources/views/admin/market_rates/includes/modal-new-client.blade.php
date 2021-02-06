{{-- Modal para agregar clientes en la cotizacion--}}
<div class="modal fade" id="add_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar cliente</h1>
        </div>
        <div class="modal-body">
          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible" role="alert">
              <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                  @foreach ($errors->all() as $error)
                      <li style="list-style-type: none;">{{ $error }} </li>
                  @endforeach
              
              </ul>
              
          </div>
          @endif

        <form action="{{ route('clients.create') }}" id="form-add-new" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="admin" value="1"> 
          
        {{-- Formulario --}}
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tabPersonalData" data-toggle="tab">Datos Personales</a></li>
                    <li><a href="#tabInvoice" data-toggle="tab">Datos de Facturación</a></li>
                </ul>
            </div>
                
            <div class="panel-body">
                <div class="tab-content">
                    
                    <div class="tab-pane fade in active" id="tabPersonalData">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                            <label for="firstname">Nombre:</label>
                            <input type="text" id="firstname" required name="firstname" maxLength='255' 
                                placeholder="Ingrese un nombre" autocomplete="off"  class="form-control" value="{{old('firstname')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                            <label for="secondname">Apellidos:</label>
                            <input type="text" id="secondname" name="secondname" maxLength='100' 
                                placeholder="Opcional"  autocomplete="off"  class="form-control" value="{{old('secondname')}}" >
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                            <label for="phone">Teléfono:</label>
                            <input type="text" id="phone" name="phone" maxLength='10' 
                            placeholder="Ingrese un número de teléfono" autocomplete="off"  class="form-control" value="{{old('phone')}}">
                        </div>
                        
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-bottom: 10px;">
                            <label for="email">Correo electronico:</label>
                            <input type="email" id="email" name="email" required maxLength='100' 
                            placeholder="Ingrese un correo electroníco" autocomplete="off"  class="form-control" value="{{old('email')}}">
                        </div>
                    </div>
        
                    <div class="tab-pane fade" id="tabInvoice">
                        <div class="col-xs-6 col-sm-xs-6 col-md-xs-6 col-lg-xs-6" style="padding-bottom: 10px;">
                            <label for="socialname">Nombre o razón social:</label>
                            <input type="text" id="socialname" name="socialname" maxLength='100' autocomplete="off" class="form-control" value="{{old('socialname')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                            <label for="facturacion">Tipo de facturación:</label>
                            <select name="facturacion" id="facturacion" class="form-control">
                                <option value="">Elegir</option>
                                <option value="Persona física">Persona física</option>
                                <option value="Persona moral">Persona moral</option>
                            </select>
                            <script>
                                document.getElementById("facturacion").value="{{old('facturacion')}}"
                            </script>
                            {{-- <input type="text" id="facturacion" name="facturacion" maxLength='100' autocomplete="off"  class="form-control" value="{{old('facturacion')}}"> --}}
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-bottom: 10px;">
                            <label for="mainstreet">Calle:</label>
                            <input type="text" id="mainstreet" name="mainstreet" maxLength='300' autocomplete="off" class="form-control" value="{{old('mainstreet')}}">
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                                <label for="rfc">RFC:</label>
                                <input type="text" id="rfc" name="rfc" maxLength='13' autocomplete="off" class="form-control" value="{{old('rfc')}}">
                        </div>    
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                            <label for="exterior">N° Exterior:</label>
                            <input type="text" id="exterior" name="exterior" maxLength='6' autocomplete="off" class="form-control" value="{{old('exterior')}}">
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                            <label for="interior">N° Interior:</label>
                            <input type="text" id="interior" name="interior" maxLength='6' autocomplete="off" class="form-control" value="{{old('interior')}}" placeholder="Opcional">
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                            <label for="cp">Código Postal:</label>
                            <input type="text" id="cp" name="cp" maxLength='5' autocomplete="off" class="form-control" value="{{old('cp')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                            <label for="state">Estado:</label>
                            <input type="text" id="state" name="state" maxLength='100' autocomplete="off" class="form-control" value="{{old('state')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                            <label for="city">Ciudad:</label>
                            <input type="text" id="city" name="city" maxLength='100' autocomplete="off" class="form-control" value="{{old('city')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                            <label for="colony">Colonia:</label>
                            <input type="text" id="colony" name="colony" maxLength='100' autocomplete="off" class="form-control" value="{{old('colony')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
                            <label for="cfdi">Razón CFDI:</label>
                            <select name="cfdi" id="cfdi" class="form-control" style="padding-bottom: 10px;">
                                <option value="">Elegir uno</option>
                                <option value="Adquisición de mercancias">Adquisición de mercancias</option>
                                <option value="Equipo de computo y accesorios">Equipo de computo y accesorios</option>
                            </select> 
                            <script>
                                document.getElementById("cfdi").value="{{old('cfdi')}}"
                            </script>   
                            {{-- <input type="text" id="cfdi" name="cfdi" maxLength='100' autocomplete="off"  class="form-control" value="{{old('cfdi')}}"> --}}
                        </div>
                    </div>
                    
                </div>
            
            </div>
            
        </div>
        
          
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-add-newmarket">Agregar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
              
         
        </form>
    </div>
        
      </div>
    </div>
  </div>

  