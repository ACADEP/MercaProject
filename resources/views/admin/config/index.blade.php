@extends('admin.dash')

@section('content')

<section class="content-header">
        <h1>
           Configuración
        </h1>
        
</section><br>

<form action="" method="POST">
            {{csrf_field()}}
            <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
            </div>
            
        <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">General</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">PDF Cotizaciones</a></li>
                          
                        </ul>
                </div>
                
                <div class="panel-body">
                   
                        
                    <div class="tab-content">
                       
                            <div class="tab-pane fade in active" id="tab1primary">
                            
                            </div>
                            <div class="tab-pane fade" id="tab2primary">
                            
                            </div>
                    </div>

                        
                
                </div>
            

        </div>
            </form>
@stop