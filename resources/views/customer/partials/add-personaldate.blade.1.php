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
                <form action="{{ route('customer.personal.add') }}" method="POST" id="paymentForm">
                    {{csrf_field()}}
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
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
                    
                    <div class="text-center" style="padding-bottom: 30px;">
                        <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                    
                </form>
            </div>
      
        </div>
    </div>
</div>
