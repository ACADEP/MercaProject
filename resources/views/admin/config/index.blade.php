@extends('admin.dash')

@section('content')

<section class="content-header">
        <h1>
           Configuración
        </h1>
        
</section><br>

<form action="{{route('update-config')}}" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
            </div>
            
        <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">API</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">General</a></li>
                            <li><a href="#tab3primary" data-toggle="tab">PDF</a></li>
                          
                        </ul>
                </div>
                
                <div class="panel-body">
                   
                        
                    <div class="tab-content">
                       
                            <div class="tab-pane fade in active" id="tab1primary">
                                <label for="api_openpay">Api key de open pay:</label>
                                <input type="text" id="api_openpay" name="api_openpay" autocomplete="off" class="form-control"  value="{{config('configurations.api.api_key_openpay')}}">
                                <label for="openpay_clientId">Client id de open pay:</label>
                                <input type="text" id="openpay_clientId" name="openpay_clientId" autocomplete="off" class="form-control"  value="{{config('configurations.api.openpay_client_id')}}">
                                <label for="api_enviaya">Api key de envia ya:</label>
                                <input type="text" id="api_enviaya" name="api_enviaya" class="form-control"  value="{{config('configurations.api.api_key_enviaya')}}">
                                <label for="api_enviaya">Modo paypal:</label>
                                <select name="mode_paypal" id="select_mode_paypal" class="form-control">
                                    <option value="sandbox">Sandbox</option>
                                    <option value="production">Producción</option>
                                </select>
                                <script>
                                    document.getElementById('select_mode_paypal').value="{{config('configurations.api.paypal-type')}}";
                                </script>
                                <label for="api_paypal">Api key de pay pal:</label>
                                <input type="text" id="api_paypal" name="api_paypal" class="form-control"  value="{{config('configurations.api.pay-pal-key')}}">
                                
                            </div><!-- Fin tab 1-->

                            <div class="tab-pane fade" id="tab2primary">
                            <div class="col-md-12"><h3>Logos</h3></div>
                            
                            <div class="col-md-6">
                                    <label for="paginate">Logo principal:</label>
                                    <img class="img-responsive" style="height:100px;" src="{{config('configurations.general.main_logo')}}">
                                    <input type="file" name="main_logo" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="paginate">Mini logo:</label>
                                    <img class="img-responsive" style="height:100px;" src="{{config('configurations.general.mini_logo')}}">
                                    <input type="file" name="mini_logo" class="form-control">
                                </div>
                             
                                <div class="col-md-12"><h3>Datos de la empresa</h3></div>

                                <div class="col-md-6">
                                   
                                    <label for="company_name">Nombre de la tienda:</label>
                                    <input type="text" id="store_name" name="store_name" autocomplete="off" class="form-control"  value="{{config('configurations.general.store_name')}}">
                                    <label for="company">Nombre de la empresa:</label>
                                    <input type="text" id="company" name="company_name" autocomplete="off" class="form-control"  value="{{config('configurations.company.name')}}">
                                    <label for="country">Codigo de pais:</label>
                                    <input type="text" id="country" name="country" autocomplete="off" class="form-control"  value="{{config('configurations.company.country_code')}}">
                                    <label for="phone">Teléfono:</label>
                                    <input type="text" id="phone" name="phone" autocomplete="off" class="form-control"  value="{{config('configurations.company.phone')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">Ciudad:</label>
                                    <input type="text" id="city" name="city" autocomplete="off" class="form-control"  value="{{config('configurations.company.city')}}">
                                    <label for="cp">Codigo postal:</label>
                                    <input type="text" id="cp" name="cp" autocomplete="off" class="form-control"  value="{{config('configurations.company.postal_code')}}">
                                    <label for="street_1">Primera calle:</label>
                                    <input type="text" id="street_1" name="street_1" autocomplete="off" class="form-control"  value="{{config('configurations.company.direction_1')}}">
                                </div>

                                <div class="col-md-12"><h3>Paginación</h3></div>

                                <div class="col-md-12">
                                <label for="paginate">Paginación de elementos:</label>
                                <input type="text" id="paginate" name="paginate" style="width:30%;" autocomplete="off" class="form-control"  value="{{config('configurations.paginate_general')}}">
                               </div>
                             
                              
                               
                               <div class="col-md-12"><h3>Carrusel principal</h3></div>

                                    <div class="col-md-12">
                                        <label for="carrusel_slogan">Slogan:</label>
                                        <input type="text" id="carrusel_slogan" name="carrusel_slogan" autocomplete="off" class="form-control"  value="{{config('configurations.general.carrusel_slogan')}}">
                                    </div>

                                    <div class="col-md-4">
                                        
                                        <label for="paginate">Primer slider:</label>
                                        <img class="img-responsive" style="height:100px;" src="{{config('configurations.general.carrusel_1')}}">
                                        <input type="file" name="carrusel_1" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="paginate">Segundo slider:</label>
                                        <img class="img-responsive" style="height:100px;" src="{{config('configurations.general.carrusel_2')}}">
                                        <input type="file" name="carrusel_2" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="paginate">Tercer slider:</label>
                                        <img class="img-responsive" style="height:100px;" src="{{config('configurations.general.carrusel_3')}}">
                                        <input type="file" name="carrusel_3" class="form-control">
                                    </div>
                               
                                
                            </div><!-- Fin tab 2-->

                            <div class="tab-pane fade" id="tab3primary">
                                    <label for="slogan">Slogan:</label>
                                    <input type="text" id="slogan" name="slogan" autocomplete="off" class="form-control"  value="{{config('configurations.mk.slogan')}}">
                                    <label for="information_final">Información final:</label>
                                    <input type="text" id="information_final" name="information_final" autocomplete="off" class="form-control"  value="{{config('configurations.mk.information_final')}}">
                            </div><!-- Fin tab 3-->
                    </div>

                        
                
                </div>
            

        </div>
            </form>
@stop

@section("msg-success")
@if(Session::has('success'))
    <script> 
        $.notify({
            // options
            message: '<strong>{{ Session("success") }} favor de recargar la página para visualizar cambios</strong>' 
        },{
            // settings
            type: 'success',
            delay:5000
        });
       
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script> 
            $.notify({
                // options
                message: '<strong>{{ $error }}</strong>' 
            },{
                // settings
                type: 'danger',
                delay:5000
            });
        </script>
    @endforeach
@endif

@stop