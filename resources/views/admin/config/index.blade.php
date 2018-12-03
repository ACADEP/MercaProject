@extends('admin.dash')

@section('content')

<section class="content-header">
        <h1>
           Configuración
        </h1>
        
</section><br>

<form action="{{route('update-config')}}" method="POST">
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
                                <label for="api_enviaya">Api key de envia ya:</label>
                                <input type="text" id="api_enviaya" name="api_enviaya" class="form-control"  value="{{config('configurations.api.api_key_enviaya')}}">
                                
                            </div><!-- Fin tab 1-->

                            <div class="tab-pane fade" id="tab2primary">
                                <label for="company_name">Nombre de la empresa:</label>
                                <input type="text" id="company_name" name="company_name" autocomplete="off" class="form-control"  value="{{config('configurations.general.company_name')}}">
                                <label for="paginate">Paginación de elementos:</label>
                                <input type="text" id="paginate" name="paginate" autocomplete="off" class="form-control"  value="{{config('configurations.paginate_general')}}">
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

@stop