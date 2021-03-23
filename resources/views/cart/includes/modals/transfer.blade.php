<div class="modal fade" id="transfer" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Transferencia Bancaria</h5>
          </button>
        </div>
        <div class="modal-body">
        <form action="/cart/confirmation-banco" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="ship_rate_total" class="rate_delivered">
              <input type="hidden" name="method_pay" id="method_pay_bank">
              <input type="hidden" name="ship_rate" id="ship_rate_bank">
              <input type="hidden" name="date_ship" id="date_ship_bank">
              <input type="hidden" name="carrie" id="bank_carrie">
              <input type="hidden" name="carrie_id" id="bank_carrie_id">
              <button type="submit" class="btn btn-primary" id="btn-bank-method">Generar recibo</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </form>
         
        </div>
      </div>
    </div>
  </div>
  <script>
  
    $("#btn-bank-method").click(function(){
        
        $("#loader-contener").html("<div id='loader' class='text-center alert alert-success' style='font-size:40px;'>Generando el recibo espere por favor</div>");

    });
  </script>