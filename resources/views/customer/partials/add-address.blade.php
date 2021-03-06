<div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar Dirección</h1>
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
                <form action="{{ route('customer.address.add') }}" method="POST" id="paymentForm">
                    {{csrf_field()}}
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                            <label for="mainstreet">Calle principal:</label>
                            <input type="text" id="mainstreet" name="mainstreet" maxLength='100' autocomplete="off" required class="form-control" value="{{old('mainstreet')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="streetsecond">Segunda calle:</label>
                            <input type="text" id="streetsecond" name="streetsecond" maxLength='100' autocomplete="off"  class="form-control" value="{{old('streetsecond')}}" placeholder="Opcional">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="streetthird">Tercera Calle:</label>
                            <input type="text" id="streetthird" name="streetthird" maxLength='100' autocomplete="off"  class="form-control" value="{{old('streetthird')}}" placeholder="Opcional">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="state">Estado:</label>
                            {{-- <select name="state" id="state" class="form-control">
                                <option value="? undefined:undefined ?"></option>
                            </select> --}}
                            <input type="text" id="state" name="state" maxLength='100' autocomplete="off" required class="form-control" value="{{old('state')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="city">Ciudad:</label>
                            {{-- <select name="city" id="city" class="form-control">
                                <option value="? undefined:undefined ?"></option>
                            </select> --}}
                            <input type="text" id="city" name="city" maxLength='100' autocomplete="off" required class="form-control" value="{{old('city')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="colony">Colonia:</label>
                            {{-- <select name="colony" id="colony" class="form-control">
                                <option value="? undefined:undefined ?"></option>
                            </select> --}}
                            <input type="text" id="colony" name="colony" maxLength='100' autocomplete="off" required class="form-control" value="{{old('colony')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="postalcode">Código postal:</label>
                            {{-- <select name="postalcode" id="postalcode" class="form-control">
                                <option value="? undefined:undefined ?"></option>
                            </select> --}}
                            <input type="text" id="postalcode" name="postalcode" maxLength='5' minLength='5' autocomplete="off" required class="form-control cp" value="{{old('postalcode')}}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="numinterior">Número interior:</label>
                            <input type="text" id="numinterior" name="numinterior" maxLength='5' autocomplete="off"  class="form-control" value="{{old('numinterior')}}" placeholder="Opcional">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px">
                            <label for="numexterior">Número exterior:</label>
                            <input type="text" id="numexterior" name="numexterior" maxLength='6' autocomplete="off"  class="form-control" value="{{old('numexterior')}}" placeholder="Opcional">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                            <label for="references">Referencias:</label>
                            <textarea class="form-control" rows="5" id="references" name="references" maxLength='2500' style="resize: none;" value="{{old('references')}}" placeholder="Opcional"></textarea>
                        </div>

                    </div>
                    
                    <div class="text-center" style="padding-bottom: 30px;">
                        <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                    
                </form>
            </div>
      
        </div>
    </div>
</div>

