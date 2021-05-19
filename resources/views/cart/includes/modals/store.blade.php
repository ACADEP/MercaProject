<div class="modal fade" id="store" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tiendas de convenencia</h5>
          </button>
        </div>
        <div class="modal-body">
        <form action="/cart/confirmation-store" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="ship_rate_total" class="rate_delivered">
          <input type="hidden" name="method_pay" id="method_pay_store">
          <input type="hidden" name="ship_rate" id="ship_rate_store">
          <input type="hidden" name="date_ship" id="date_ship_store">
          <input type="hidden" name="carrie" id="store_carrie">
          <input type="hidden" name="carrie_id" id="store_carrie_id">
          <button type="submit" class="btn btn-primary" id="btn-store-method">Generar recibo</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
         
        </div>
      </div>
    </div>
  </div>
  
  <script>
          $("#btn-store-method").click(function(){
              $("#loader-contener").html("<div id='loader' class='text-center alert alert-success' style='font-size:40px;'>Generando el recibo espere por favor</div>");
          });
  </script>