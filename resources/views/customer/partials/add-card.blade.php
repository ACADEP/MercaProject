<div class="modal fade" id="add_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar tarjeta de crédito o débito</h1>
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
      </div>

      <script type="text/javascript">
        $(document).ready(function() {

            var deviceSessionId = OpenPay.deviceData.setup("customer-form", "device_session_id");

            $('#save-button').on('click', function(event) {
                event.preventDefault();
                $("#save-button").prop( "disabled", true);
                OpenPay.token.extractFormAndCreate('customer-form', success_callbak, error_callbak);
            });

            var success_callbak = function(response) {
                var token_id = response.data.id;
                // alert(token_id);
                //$('#token_id').val(token_id);
                document.addClient.token_id.value = token_id;
                $('#customer-form').submit();
            };

            var error_callbak = function(response) {
                var desc = response.data.description != undefined ? response.data.description : response.message;
                alert("ERROR [" + response.status + "] " + desc);
                $("#save-button").prop("disabled", false);
            };

        });
      </script>

      <form action="/save_customer_card" method="POST" id="customer-form" name="addClient">
        {{ csrf_field() }}
        <input type="hidden" name="token_id" id="token_id">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
            <label>Nombre</label>
            <input type="text" class="form-control" size="20" autocomplete="off" data-openpay-card="holder_name" />
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-bottom: 10px;">
            <label>N&uacute;mero</label>
            <input type="text" class="form-control" size="20" autocomplete="off" data-openpay-card="card_number" />
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px; padding-top: 21px;">
              <label>CVV2</label>
              <input type="text" class="form-control" size="4" autocomplete="off" data-openpay-card="cvv2" />
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px;">
              <label>Fecha de expiraci&oacute;n (MM/YY)</label>
              <input type="text" class="form-control" size="2" data-openpay-card="expiration_month" />
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 10px; padding-top: 45px;">
              <input type="text" class="form-control" size="2" data-openpay-card="expiration_year" />
          </div>
        </div>
        
        <div class="text-center" style="padding-bottom: 30px;">
            <input type="submit" id="save-button" value="Aceptar" class="btn btn-primary"/> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </form>

    </div>
  </div>
</div>

