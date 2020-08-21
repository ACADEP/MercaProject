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
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                    <label for="firstname">Nombre:</label>
                    <input type="text" id="firstname" name="firstname" maxLength='100' autocomplete="off"  class="form-control" value="{{old('firstname', $data->nombre)}}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                    <label for="secondname">Apellidos:</label>
                    <input type="text" id="secondname" name="secondname" maxLength='100' autocomplete="off"  class="form-control" value="{{old('secondname', $data->apellidos)}}" placeholder="Opcional">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                    <label for="phone">Teléfono:</label>
                    <input type="text" id="phone" name="phone" maxLength='10' autocomplete="off"  class="form-control" value="{{old('phone', $data->telefono)}}">
                </div>
                
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-bottom: 10px;">
                    <label for="email">Correo electronico:</label>
                    <input type="email" id="email" name="email" maxLength='100' autocomplete="off"  class="form-control" value="{{old('email', $data->email)}}">
                </div>
            </div>

            <div class="tab-pane fade" id="tab2primary">
                <div class="col-xs-6 col-sm-xs-6 col-md-xs-6 col-lg-xs-6" style="padding-bottom: 10px;">
                    <label for="socialname">Nombre o razón social:</label>
                    <input type="text" id="socialname" name="socialname" maxLength='100' autocomplete="off" class="form-control" value="{{old('socialname', $data->razonSocial)}}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                    <label for="facturacion">Tipo de facturación:</label>
                    <select name="facturacion" id="facturacion" class="form-control">
                        <option value="">Elegir</option>
                        <option value="Persona física">Persona física</option>
                        <option value="Persona moral">Persona moral</option>
                    </select>
                    <script>
                        document.getElementById("facturacion").value="{{old('facturacion', $data->tipoFacturacion)}}"
                    </script>
                    {{-- <input type="text" id="facturacion" name="facturacion" maxLength='100' autocomplete="off"  class="form-control" value="{{old('facturacion')}}"> --}}
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-bottom: 10px;">
                    <label for="mainstreet">Calle:</label>
                    <input type="text" id="mainstreet" name="mainstreet" maxLength='300' autocomplete="off" class="form-control" value="{{old('mainstreet', $data->calle)}}">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                        <label for="rfc">RFC:</label>
                        <input type="text" id="rfc" name="rfc" maxLength='13' autocomplete="off" class="form-control" value="{{old('rfc', $data->rfc)}}">
                </div>    
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                    <label for="exterior">N° Exterior:</label>
                    <input type="text" id="exterior" name="exterior" maxLength='6' autocomplete="off" class="form-control" value="{{old('exterior',$data->numExterior)}}">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                    <label for="interior">N° Interior:</label>
                    <input type="text" id="interior" name="interior" maxLength='6' autocomplete="off" class="form-control" value="{{old('interior', $data->numInterior)}}" placeholder="Opcional">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
                    <label for="cp">Código Postal:</label>
                    <input type="text" id="cp" name="cp" maxLength='5' autocomplete="off" class="form-control" value="{{old('cp', $data->cp)}}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                    <label for="state">Estado:</label>
                    <input type="text" id="state" name="state" maxLength='100' autocomplete="off" class="form-control" value="{{old('state', $data->estado)}}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                    <label for="city">Ciudad:</label>
                    <input type="text" id="city" name="city" maxLength='100' autocomplete="off" class="form-control" value="{{old('city', $data->ciudad)}}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
                    <label for="colony">Colonia:</label>
                    <input type="text" id="colony" name="colony" maxLength='100' autocomplete="off" class="form-control" value="{{old('colony', $data->colonia)}}">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
                    <label for="cfdi">Razón CFDI:</label>
                    <select name="cfdi" id="cfdi" class="form-control" style="padding-bottom: 10px;">
                        <option value="">Elegir uno</option>
                        <option value="Adquisición de mercancias">Adquisición de mercancias</option>
                        <option value="Equipo de computo y accesorios">Equipo de computo y accesorios</option>
                    </select> 
                    <script>
                        document.getElementById("cfdi").value="{{old('cfdi', $data->cfdi)}}"
                    </script>   
                    {{-- <input type="text" id="cfdi" name="cfdi" maxLength='100' autocomplete="off"  class="form-control" value="{{old('cfdi')}}"> --}}
                </div>
            </div>
            
        </div>
    
    </div>
    
</div>