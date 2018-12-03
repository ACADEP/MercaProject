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
                            <li><a href="#tab3primary" data-toggle="tab">PDF Cotizaciones</a></li>
                          
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
                                
                            </div><!-- Fin tab 1-->

                            <div class="tab-pane fade" id="tab2primary">
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

                                <div class="col-md-12">
                                <label for="company_name">Nombre de la tienda:</label>
                                <input type="text" id="company_name" style="width:49%;" name="company_name" autocomplete="off" class="form-control"  value="{{config('configurations.general.company_name')}}">
                                </div>
                               
                                <div class="col-md-6">
                                    <label for="company">Nombre de la empresa:</label>
                                    <input type="text" id="company" name="company" autocomplete="off" class="form-control"  value="{{config('configurations.company.name')}}">
                                    <label for="country">Codigo de pais:</label>
                                    <input type="text" id="country" name="country" autocomplete="off" class="form-control"  value="{{config('configurations.company.country_code')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">Ciudad:</label>
                                    <input type="text" id="city" name="city" autocomplete="off" class="form-control"  value="{{config('configurations.company.city')}}">
                                    <label for="cp">Codigo postal:</label>
                                    <input type="text" id="cp" name="cp" autocomplete="off" class="form-control"  value="{{config('configurations.company.postal_code')}}">
                                    <label for="street">Primera calle:</label>
                                    <input type="text" id="street" name="street" autocomplete="off" class="form-control"  value="{{config('configurations.company.direction_1')}}">
                                </div>

                                <div class="col-md-12">
                                <label for="paginate">Paginación de elementos:</label>
                                <input type="text" id="paginate" name="paginate" style="width:30%;" autocomplete="off" class="form-control"  value="{{config('configurations.paginate_general')}}">
                               </div>
                                
                            </div><!-- Fin tab 2-->

                            <div class="tab-pane fade" id="tab3primary">
                            
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