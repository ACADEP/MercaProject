<div class="modal fade" id="debit-card" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="width: 10000px;">
    
            <div class="modal-body text-center">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div  style="text-align: left; margin-top: 10px;">
                                <strong style="text-aling:left; font-size: 28px">Información de pago</strong> </div>
                        </div>
                        <div class="col-md-6">
                            <img style="float: right; margin: 0px 0px 15px 15px;"  src="/images/merca.png" alt="">
                        </div>
                    
                    </div>
         
                    <script type="text/javascript">
                              $(document).ready(function() {
                                  
   
                                  //Se genera el id de dispositivo
                                  var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
                                  
                                  $('#pay-button').on('click', function(event) {
                                      $('#pay-button').prop( "disabled", true );
                                      event.preventDefault();
                                    
                                      OpenPay.token.extractFormAndCreate('payment-form', success_callbak, error_callbak);     
                                      $('#pay-button').prop( "disabled", false );
                                  });
  
                                  var success_callbak = function(response) {
                                      var token_id = response.data.id;
                                      $('#token_id').val(token_id);
                                      $("#loader-contener").html("<div id='loader' class='text-center alert alert-success' style='font-size:40px;'>Espere para completar su compra</div>");
                                      $('#payment-form').submit();
                                      setInterval(function(){
                                          $.getJSON('/progressConfirmation', function(data) {
                                              $("#loader").html(data["progress"]);
                                          });
                                      }, 1000);
  
                                  };
                                  
                                  //Errores 
                                  var error_callbak = function(response) {
                                      var desc = response.data.description != undefined ? response.data.description : response.message;
                                      var message_errors=desc.split(",");
                                      
                                      var error_code = response.status;
                                      var error_code2 = response.data.error_code;
  
                                      var error_message="Errores:";
                                      message_errors.forEach(function(error, index) {
                                          
                                          switch (error.trim()) {
                                              
                                              case "card_number is required":
                                                  error_message+=" El número de tarjeta es requerido |"
                                                  break;
  
                                              case "The card number verification digit is invalid":
                                                  error_message+=" El número de tarjeta es invalido |"
                                                  break;
  
                                              case "holder_name is required":
                                                  error_message+=" El nombre del titular es requerido |"
                                                  break;
  
                                              case "expiration_year expiration_month is required":
                                                  error_message+=" La fecha de expiracion es requerida |"
                                                  break;
  
                                              case "card_number must contain only digits":
                                                  error_message+=" El número de tarjeta debe contener solo dígitos |"
                                                  break;
  
                                              case "card_number length is invalid":
                                                  error_message+=" La longitud del número de tarjeta es invalido |"
                                                  break;
  
                                              case "The CVV2 security code is required":
                                                  error_message+=" El codigo de seguiridad es requerido |"
                                                  break;
  
                                              case "cvv2 must contain only digits":
                                                  error_message+=" El codigo de seguiridad tiene que contener solo dígitos |"
                                                  break;
  
                                              case "cvv2 length must be 3 digits":
                                                  error_message+=" El codigo de seguiridad debe contener solo 3 dígitos |"
                                                  break;
  
                                              case "cvv2 length must be 4 digits":
                                                  error_message+=" El codigo de seguiridad debe contener solo 4 dígitos |"
                                                  break;
  
                                              case "valid expirations months are 01 to 12":
                                                  error_message+=" El mes de expiración es invalido debe ser entre 01-12 |"
                                                  break;
  
                                              case "valid expirations year are 01 to 99":
                                                  error_message+=" El año de expiración es invalido debe ser entre 01-99 |"
                                                  break;
  
                                              case "expiration_year length must be 2 digits":
                                                  error_message+=" El año debe contener 2 dígitos |"
                                                  break;
                                              
                                              case "expiration_month length must be 2 digits":
                                                  error_message+=" El mes debe contener 2 dígitos |"
                                                  break;
  
                                              case "The expiration date has already passed":
                                                  error_message+=" La fecha de expiración ya ha pasado |"
                                                  break;
                                          
                                              default:
                                                  if( (error.includes("expiration_month") && error.includes("is invalid")) ||
                                                      (error.includes("expiration_year") && error.includes("is invalid")) )
                                                  { }
                                                  else
                                                  {
                                                      error_message+=" Error desconocido: "+error+" |"
                                                  }
                                                  break;
                                          }
                                          
                                      });
  
                                      //Notificacion
                                      $.notify({
                                          // options
                                          message: error_message
                                      },{
                                          // settings
                                          type: 'danger',
                                          z_index: 2000,
                                      });
                                     
                                  }
  
                              });
                    </script>
  
                                <div class="bkng-tb-cntnt">
                                 <div class="pymnts">
                                  <form action="/cart/payment/openpay" method="POST" id="payment-form">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="token_id" id="token_id">
                                      <input type="hidden" name="method_pay" id="method_pay_target">
                                      <input type="hidden" name="ship_rate" id="ship_rate_target">
                                      <input type="hidden" name="date_ship" id="date_ship_target">
                                      <input type="hidden" name="ship_rate_total" id="total-credit">
                                      <input type="hidden" name="carrie" id="openpay_carrie">
                                      <input type="hidden" name="carrie_id" id="openpay_carrie_id">
                                      

                                      
                                      <div class="row col-md-12 header-naranja">
                                       <div class="col-md-4">
                                       <div >
                                           <strong style="margin-top: 10px;">Tarjetas de crédito</strong>  </div>  
                                           <img style="margin-top: 10px;" src="/images/credito.png" alt="">
                                       </div>
                                       <div class="col-md-8 " style="padding: 0;" >
                                           <div>
                                               <strong style="margin-top: 10px;">Tarjetas de débito</strong>  </div>  
                                               <img src="/images/debito.png" alt="">
                                           </div>
                                      </div>

                                                <div class="row col-md-12 body-p">
                                                    
                                                    <div class="row col-md-12">
                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                            <label class="texts">Nombre del titular</label> 
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-10" style="padding: 0;">
                                                                    <input class="input-t" type="text" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name">
                                                                </div>
                                                                <div class="col-md-2" style="padding: 0;">
                                                                    <img src="/images/nombretitular.png" alt="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                            <label class="texts">Número de tarjeta</label>
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-10" style="padding: 0;">
                                                                     <input class="input-t" type="text" autocomplete="off" data-openpay-card="card_number" placeholder="xxxx-xxxx-xxxx-xxxx">
                                                                </div>
                                                                <div class="col-md-2" style="padding: 0;">
                                                                    <img src="/images/numerotarjeta.png" alt="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                
                                                        <div class="col-md-12 row">
                                                            <div class="col-md-6">
                                                                <label class="texts">Fecha de expiración</label>
                                                                <div class="col-md-12 row" style="padding: 0">
                                                                    <div class="col-md-5"><input class="input-b" type="text" placeholder="Mes" data-openpay-card="expiration_month"></div>
                                                                    <div class="col-md-5"><input class="input-b" type="text" placeholder="Año" data-openpay-card="expiration_year"></div>
                                                                    <div class="col-md-2" style="padding: 0;">
                                                                        <img src="/images/fecha.png" alt="">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">
                                                                <div>
                                                                    <label class="texts">Código de seguridad</label>
                                                                    <div class="col-md-12 row">
                                                                        <div class="col-md-6"><input class="input-b" type="text" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2"></div>
                                                                        <div class="col-md-6" style="padding: 0;">
                                                                            <img src="/images/cvv.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-md-12 row" style="margin-top: 30px;"> 
                                                            <div>
                                                                <div class="col-md-4 text" >
                                                                    Transacciones realizadas <br> vía:
                                                                </div>
                                                                
                                                                <div class="col-md-4">
                                                                   <img src="/images/open.png" alt="">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    
                                                                        <div class="col-md-12 " style="display:block; margin:auto;" > <img src="/images/security.png" alt=""></div>
                                                                        <div class="text col-md-12">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>

                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12" >
                                                            <button class="btn btn-success" id="pay-button">Pagar</button>
                                                        </div>
                                                    
                                                    </div>
                                  </form>
                                </div>
                              </div>
            </div>
                 
        </div> <!-- fin del modal -->
        
    </div>
</div>
  

  <style>
      .header-naranja{
        width: 100%;
        height: auto;
        background: #FF9C00;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        color: #ffffff;
        left: 15px;
        font-weight: bold;
        font-size: 23px;
        line-height: 32px;
        padding: 0;
      }

      .body-p{
     
        width: 821px;
        height: auto;
        left: 15px;
        background: #F7F7F7;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.09);
        border-radius: 16px;   
      }

      .texts{
        font-size: 25px; 
      }

      .text{
        font-size: 15px;
        line-height: 19px;
        text-align: center;
        color: #828282;

      }

      .input-t{
          width: 242px;
          height: 40px;
        background: #FFFFFF;
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        border-radius: 5px;
      }
      .input-b{
        width: 106px ;
        height: 40px;
        background: #FFFFFF;
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        border-radius: 5px;
      }
      
  </style>