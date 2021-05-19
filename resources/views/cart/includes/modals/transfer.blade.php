<div class="modal fade" id="transfer" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id="modal-content">
     
        <div class="modal-body"  id="modal-body">
          <form action="/cart/confirmation-banco" method="post">
            <div class="col-md-12 text-center" id="title">
              Transferencia Bancaria
            </div> 
            
            <div class="col-md-12 text-center" style="font-size:18px; font-weight: normal; text-aling:justify; top: 25px; ">
              <img src="/images/modals/mano.png" alt=""> &nbsp;  Descargue el siguiente recibo
            </div>
            
            

            <div class="row col-md-12 text-center" style="margin-top: 10px;">
              <div class="col-md-6 text-center" style="margin-top: 30px;">
                <img src="/images/modals/transfer.png" alt="">
            </div>
            <div class="col-md-6 text-center" >
              <div  style="font-weight: normal; text-aling:justify; margin-top: 25px; ">
                PASOS PARA REALIZAR EL PAGO  <img src="/images/modals/interrogative.png" alt="">
             </div>
              <img src="/images/modals/bbva.png" alt="">
          </div>
          </div>
        <div class="row col-md-12 text-center " style="margin-top: 30px;">
          <div class="col-md-6" style="font-weight: 600;">
            FECHA:
          </div>
          <div class="col-md-6" style="font-weight: 600;">
            TOTAL:
          </div>
      </div>

      
              {{ csrf_field() }}
              <input type="hidden" name="ship_rate_total" class="rate_delivered">
              <input type="hidden" name="method_pay" id="method_pay_bank">
              <input type="hidden" name="ship_rate" id="ship_rate_bank">
              <input type="hidden" name="date_ship" id="date_ship_bank">
              <input type="hidden" name="carrie" id="bank_carrie">
              <input type="hidden" name="carrie_id" id="bank_carrie_id">

              <div class="col-md-12 row  text-center" style="margin-left: 5px; margin-top: 20px; ">
                <div  class="col-md-4 col-sm-6 col-xs-8">
                  <button type="button" class="boton2 btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>   
                <div  class="col-md-8 col-sm-6 col-xs-12">
                  <button type="submit" class="botoon btn btn-primary" id="btn-bank-method">Generar recibo</button>
                </div>   
            </div>
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

<style>
  #title{
    position: static;

    font-family: sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 33px;
    color: #000000;

  }
  .botoon{
    background: #164DCE;
    color: #FFFFFF;
    font-weight: bold;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #000000;
    width: 100%!important;
    height: 50px;
    
    }

    .boton2{
      background: #FFFFFF !important;
      color: #000000 !important;
      font-weight: bold;
      font-size: 14px;
      border-radius: 6px;
      border: 1px solid #000000;
      width: 120px;
      height: 50px;
      
      
    }

    .btn-secondary:hover {
    background-color: #164DCE !important;
    color: #FFFFFF !important;
}

    #modal-body{
      
      width: 100%;
      height: auto;
      font-family: Arial, Helvetica, sans-serif;     
      background: #FFFFFF;
      color: #000000;
      box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.12);
      border-radius: 16px !important;
    }
    #modal-content{
      background: #FFFFFF;
      box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.12);
      border-radius: 16px !important;
    }
    
  
</style>
