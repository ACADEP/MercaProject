<div class="modal fade" id="add_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar tarjeta de crédito o débito</h1>
      </div>
      <div class="modal-body">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> 
    

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible" role="alert">
              <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                  @foreach ($errors->all() as $error)
                      <li style="list-style-type: none;">{{ $error }} </li>
                  @endforeach
              </ul>
          </div>
        @endif
      </div>

        <form action="{{ route('customer.payments.add') }}" method="POST" id="paymentForm">
            {{csrf_field()}}
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                <label for="numcard">Número de tarjeta:</label>
                <input type="text" id="card_number" name="numcard" maxLength='16' minLength="13" autocomplete="off" required class="form-control" value="{{old('numcard')}}">
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px">
                <label for="name">Titular:</label>
                <input type="text" id="name_on_card" name="name" maxLength='100' autocomplete="off" required class="form-control" value="{{old('name')}}">
              </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                  <label for="mes">Mes:</label>
                  <input name="mes" class="date-own form-control" id="expiry_month" type="text" required class="form-control">
                  <script type="text/javascript">
                      $('.date-own').datepicker({
                        minViewMode: 1,
                        format: 'mm'
                      });
                  </script>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                  <label for="año">Año:</label>
                  <input name="año" class="date-own form-control" id="expiry_year" type="text" required class="form-control">
                  <script type="text/javascript">
                      $('.date-own').datepicker({
                        minViewMode: 2,
                        format: 'yy'
                      });
                  </script>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px">
                  <label for="cvccode">CVC:</label>
                  <input type="text" id="cvv" name="cvccode" data-toggle="tooltip" data-placement="bottom" title="Este número aparece en el reverso de la tarjeta, en la zona de la firma. Son los tres últimos dígitos (después del número de cuenta)." maxLength='3' autocomplete="off" required class="form-control" value="{{old('cvccode')}}">
                  <script>
                    $(function () {
                      $('[data-toggle="tooltip"]').tooltip()
                    })
                  </script>
                </div>
            </div>
            
            <div class="text-center" style="padding-bottom: 30px;">
                <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            
        </form>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <script src="{{ asset('/js/creditCardValidator.js') }}"></script>
    </div>
  </div>
</div>

