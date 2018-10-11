<div class="modal fade" id="add_personaldate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar Datos Personales</h1>
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
                <form action="{{ route('customer.personal.add') }}" method="POST">
                    {{csrf_field()}}
                    <div class="text-right" style="margin-bottom:5px;">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                    
                    <div class="panel with-nav-tabs panel-primary">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1primary" data-toggle="tab">Datos Personales</a></li>
                                <li><a href="#tab2primary" data-toggle="tab">Datos de Facturación</a></li>
                            </ul>
                        </div>
                            
                        <div class="panel-body">
                            <div class="tab-content">
                                
                                <div class="tab-pane fade in active" id="tab1primary">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                                        <label for="name">Nombre:</label>
                                        <input type="text" id="name" name="name" maxLength='100' autocomplete="off" required class="form-control" value="{{old('name')}}">
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                                        <label for="firstname">Primer Apellido:</label>
                                        <input type="text" id="firstname" name="firstname" maxLength='100' autocomplete="off"  class="form-control" value="{{old('firstname')}}">
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                                        <label for="secondname">Segundo Apellido:</label>
                                        <input type="text" id="secondname" name="secondname" maxLength='100' autocomplete="off"  class="form-control" value="{{old('secondname')}}" placeholder="Opcional">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                                        <label for="phone">Teléfono:</label>
                                        <input type="text" id="phone" name="phone" maxLength='10' autocomplete="off"  class="form-control" value="{{old('phone')}}">
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab2primary">
                                    <div class="col-xs-6 col-sm-xs-6 col-md-xs-6 col-lg-xs-6" style="padding-bottom: 10px">
                                        <label for="socialname">Nombre o razón social:</label>
                                        <input type="text" id="socialname" name="socialname" maxLength='100' autocomplete="off" class="form-control" value="{{old('socialname')}}">
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                                        <label for="facturacion">Tipo de facturación:</label>
                                        <select name="facturacion" id="facturacion" class="form-control">
                                            <option value="? undefined:undefined ?"></option>
                                            <option value="Persona física">Persona física</option>
                                            <option value="Persona moral">Persona moral</option>
                                        </select>
                                        {{-- <input type="text" id="facturacion" name="facturacion" maxLength='100' autocomplete="off"  class="form-control" value="{{old('facturacion')}}"> --}}
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-bottom: 10px">
                                        <label for="mainstreet">Calle:</label>
                                        <input type="text" id="mainstreet" name="mainstreet" maxLength='300' autocomplete="off" class="form-control" value="{{old('mainstreet')}}">
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                                            <label for="rfc">RFC:</label>
                                            <input type="text" id="rfc" name="rfc" maxLength='13' autocomplete="off" class="form-control" value="{{old('rfc')}}">
                                    </div>    
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                                        <label for="exterior">N° Exterior:</label>
                                        <input type="text" id="exterior" name="exterior" maxLength='6' autocomplete="off" class="form-control" value="{{old('exterior')}}">
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                                        <label for="interior">N° Interior:</label>
                                        <input type="text" id="interior" name="interior" maxLength='6' autocomplete="off" class="form-control" value="{{old('interior')}}" placeholder="Opcional">
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                                        <label for="cp">Código Postal:</label>
                                        <input type="text" id="cp" name="cp" maxLength='5' autocomplete="off" class="form-control" value="{{old('cp')}}">
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                                        <label for="state">Estado:</label>
                                        <input type="text" id="state" name="state" maxLength='100' autocomplete="off" class="form-control" value="{{old('state')}}">
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                                        <label for="city">Ciudad:</label>
                                        <input type="text" id="city" name="city" maxLength='100' autocomplete="off" class="form-control" value="{{old('city')}}">
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                                        <label for="colony">Colonia:</label>
                                        <input type="text" id="colony" name="colony" maxLength='100' autocomplete="off" class="form-control" value="{{old('colony')}}">
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                                        <label for="cfdi">Razón CFDI:</label>
                                        <select name="cfdi" id="cfdi" class="form-control">
                                            <option value="? undefined:undefined ?"></option>
                                            <option value="Adquisición de mercancias">Adquisición de mercancias</option>
                                            <option value="Equipo de computo y accesorios">Equipo de computo y accesorios</option>
                                        </select>    
                                        {{-- <input type="text" id="cfdi" name="cfdi" maxLength='100' autocomplete="off"  class="form-control" value="{{old('cfdi')}}"> --}}
                                    </div>
                                </div>
                                
                            </div>
                        
                        </div>
                        
                    </div>
                </form>
                
            </div>
        
        </div>
    </div>
</div>
      
      