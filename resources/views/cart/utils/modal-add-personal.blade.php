<div class="modal fade" id="add_personal_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar Datos Personales</h1>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('customer.personal.add') }}" method="POST">
                    {{csrf_field()}}
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                        <a class="nav-link active" style="color:black;" data-toggle="tab" href="#tab1">Datos Personales</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" style="color:black;" data-toggle="tab" href="#tab2">Datos de facturación</a>
                        </li>
                       
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active " id="tab1">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                                <label for="name">Nombre:</label>
                                <input type="text" id="name" name="name" maxLength='100' autocomplete="off" required class="form-control" value="{{old('name')}}">
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row">
                                
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                                    <label for="firstname">Primer Apellido:</label>
                                    <input type="text" id="firstname" name="firstname" maxLength='100' autocomplete="off"  class="form-control" value="{{old('firstname')}}">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label for="secondname">Segundo Apellido:</label>
                                    <input type="text" id="secondname" name="secondname" maxLength='100' autocomplete="off"  class="form-control" value="{{old('secondname')}}" placeholder="Opcional">
                                </div>
                                
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="phone">Teléfono:</label>
                                <input type="text" required id="phone" name="phone" maxLength='10' autocomplete="off"  class="form-control" value="{{old('phone')}}">
                            </div>
                        </div>

                        <div class="tab-pane container fade" id="tab2">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="socialname">Nombre o razón social:</label>
                                <input type="text" id="socialname" name="socialname" maxLength='100' autocomplete="off" class="form-control" value="{{old('socialname')}}">
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="facturacion">Tipo de facturación:</label>
                                <select name="facturacion" id="facturacion" class="form-control w-100" >
                                    <option value="? undefined:undefined ?"></option>
                                    <option value="Persona física">Persona física</option>
                                    <option value="Persona moral">Persona moral</option>
                                </select>
                                {{-- <input type="text" id="facturacion" name="facturacion" maxLength='100' autocomplete="off"  class="form-control" value="{{old('facturacion')}}"> --}}
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="mainstreet">Calle:</label>
                                <input type="text" id="mainstreet" name="mainstreet" maxLength='300' autocomplete="off" class="form-control" value="{{old('mainstreet')}}">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="rfc">RFC:</label>
                                    <input type="text" id="rfc" name="rfc" maxLength='13' autocomplete="off" class="form-control" value="{{old('rfc')}}">
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row">

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label for="exterior">N° Exterior:</label>
                                    <input type="text" id="exterior" name="exterior" maxLength='6' autocomplete="off" class="form-control" value="{{old('exterior')}}">
                                </div>
    
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label for="interior">N° Interior:</label>
                                    <input type="text" id="interior" name="interior" maxLength='6' autocomplete="off" class="form-control" value="{{old('interior')}}" placeholder="Opcional">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="state">Estado:</label>
                                <select id="state" name="state" class="form-control">
                                    @foreach (config("enums.states") as $item)
                                        <option @if(old("state")==$item) selected @endif 
                                        value="{{$item}}">{{$item}}</option>                  
                                    @endforeach
                                </select>
                              
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row">

                            </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <label for="cp">Código Postal:</label>
                                    <input type="text" id="cp" name="cp" maxLength='5' autocomplete="off" class="form-control" value="{{old('cp')}}">
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <label for="city">Ciudad:</label>
                                    <input type="text" id="city" name="city" maxLength='100' autocomplete="off" class="form-control" value="{{old('city')}}">
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <label for="colony">Colonia:</label>
                                    <input type="text" id="colony" name="colony" maxLength='100' autocomplete="off" class="form-control w-100" value="{{old('colony')}}">
                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                <label for="cfdi">Razón CFDI:</label>
                                <select name="cfdi" id="cfdi" class="form-control" style="padding-bottom: 10px; border-radius: 1 !important; border-color: #fff !important;">
                                    <option value="">Elegir</option>
                                    <option value="G-03">G-03</option>
                                    <option value="Adquisición de mercancias">Adquisición de mercancias</option>
                                    <option value="Equipo de computo y accesorios">Equipo de computo y accesorios</option>
                                </select>    
                                {{-- <input type="text" id="cfdi" name="cfdi" maxLength='100' autocomplete="off"  class="form-control" value="{{old('cfdi')}}"> --}}
                            </div>
                        </div>
                      
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" >Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>

                
            </div>
        
        </div>
    </div>
</div>
      
      