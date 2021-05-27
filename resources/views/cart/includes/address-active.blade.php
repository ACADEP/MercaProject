  <!-- First Step -->
    <!-- <form role="form" action="" method="post"> -->
        <div class="row setup-content-2" id="step-1">


            <div class="col-md-12">
           
            <div class="col-md-6 direction-title" style="padding: 0; margin-top: 10px;">Dirección</div>

            @php $i=1;@endphp
                @if($addresses->count() > 0)
                    
                        <div class="text-right">
                            
                            @if($addresses->count() < 3 )
                                &nbsp;&nbsp;
                                <a data-toggle="modal" data-target="#add_address" style="color:blue;">Agregar una dirección</a>
                            @endif
                        </div>

                        <div class="col-md-12 box-direction" style="margin-top: 10px;">
                                <div class="row col-md-6 text1-direction" style="margin-left: 2px;">
                                    Será enviado a:  
                                </div>
                            @if($addressActive)
                            
                                
                                <div class="col-md-6">
                                    <div>
                                        <a href="/customer/personal/address" style="color:blue; margin-top: 10px; font-size: 16px;">Cambiar direccion</a>
                                    </div>
                                </div>


                               <div class="col-md-12 row">

                                    <div class="col-md-12 row">

                                        <div class="col-md-4 text2-direction">
                                            &nbsp;<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
                                            <strong>CP : </strong>{{$addressActive->cp}}
                                        </div>
                                        <div class="col-md-4 text2-direction">
                                            <strong>&nbsp;Ciudad : </strong>{{ $addressActive->ciudad }} {{$addressActive->estado}} 
                                        </div>
                                        <div class="col-md-4 text2-direction">
                                            <strong>&nbsp;Colonia :</strong> {{ $addressActive->colonia }} 
                                          
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">

                                        <div class="col-md-8 text2-direction">
                                            <strong>&nbsp;Calles : </strong> {{$addressActive->calle}} entre {{ $addressActive->calle2 }} y {{ $addressActive->calle3 }} 
                                        </div>
                                        <div class="col-md-4 text2-direction">
                                            <strong>&nbsp;Número exterior : </strong> {{$addressActive->numExterior=="" ? 'No especificado': $addressActive->numExterior}} 
                                        </div>
                                        <div class="col-md-8 text3-direction">
                                            <strong>&nbsp;Referencias : </strong> {{$addressActive->referencias=="" ? 'No especificado': $addressActive->referencias}}
                                        </div>
                                        <div class="col-md-4 text3-direction">
                                            <strong>&nbsp;Número interior : </strong> {{$addressActive->numInterior=="" ? 'No especificado': $addressActive->numinterior}} 
                                        </div>
                                    </div>
                                        
                                    </div>
                            @endif
                            
                            @else
                            <div>
                                <a href="{{ url('/customer/personal/address/') }}" style="color: blue; ">Agregar una dirección</a>
                            </div>

                                <div class="alert alert-danger">Agregar una dirección de envío para continuar su proceso de pago</div> 
                            @endif

                        </div>
                    
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" style="margin-top: 10px;" type="button">Siguiente</button>
            </div>


        </div>
        <style>

            .text2-direction{
                margin-top: 20px;
                font-size: 16px;
                line-height: 23px;
            }
            .text3-direction{
                margin-top: 10px;
                font-size: 16px;
                line-height: 23px;
            }
            .text1-direction{
                
                font-style: normal;
                font-weight: normal;
                font-size: 18px;
                line-height: 28px;
            }
            .box-direction{
            padding-top: 20px;
            padding-bottom: 20px;
            width: 100%;
            height: auto;
            background: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 5px;
            }
            .direction-title{
                font-weight: 600;
                font-size: 30px;
                line-height: 40px;
                color: #4F4F4F;
            }
        </style>