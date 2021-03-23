<div class="modal fade" id="pay-pal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center" id="exampleModalLongTitle">Pay-Pal</h1>
        </div>
        <div class="modal-body text-center">
        <div id="paypal-button-container"></div>
                         
                          <input type="hidden" id="paypal-amount">
                          <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                          <script>
                          
                          // Render the PayPal button
                          paypal.Button.render({
                          // Set your environment
                          env: '{{config("configurations.api.paypal-type")}}', // sandbox | production
  
                          // Specify the style of the button
                          style: {
                          layout: 'vertical',  // horizontal | vertical
                          size:   'responsive',    // medium | large | responsive
                          shape:  'pill',      // pill | rect
                          color:  'black'       // gold | blue | silver | white | black
                          },
  
                          // Specify allowed and disallowed funding sources
                          //
                          // Options:
                          // - paypal.FUNDING.CARD
                          // - paypal.FUNDING.CREDIT
                          // - paypal.FUNDING.ELV
                          funding: {
                          allowed: [
                              paypal.FUNDING.CARD,
                              paypal.FUNDING.CREDIT
                          ],
                          disallowed: []
                          },
  
                          // PayPal Client IDs - replace with your own
                          // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                          client: {
                          sandbox: '{{config("configurations.api.paypal-type")=="sandbox" ? config("configurations.api.pay-pal-key") : "" }}',
                          production: '{{config("configurations.api.paypal-type")=="production" ? config("configurations.api.pay-pal-key") : "" }}'
                          },
  
                          payment: function (data, actions) {
                          return actions.payment.create({
                              payment: {
                              transactions: [
                                  {
                                  amount: {
                                      
                                      total: $("#paypal-amount").val(),
                                      currency: 'MXN'
                                  }
                                  }
                              ]
                              }
                          });
                          },
  
                          onAuthorize: function (data, actions) {
                          return actions.payment.execute()
                              .then(function () {
                                  var ship=$("#shipment").html();
                                  var carrie_id=$('#carrie_id').val();
                                  var ship_rate=$('#ship_rate_choosed').html();
                                  var date_ship=$('#date_aprox').html();
                                  var method_pay="PayPal";
                                  $("#loader-contener").html("<div id='loader' class='text-center alert alert-success' style='font-size:40px;'>Espere para completar su compra</div>");
                                  post("/cart/confirmation",{_token:"{{csrf_token()}}" ,carrie: ship, carrie_id: carrie_id , ship_rate: ship_rate,date_ship:date_ship,method_pay:method_pay } );
                                  setInterval(function(){
                                      $.getJSON('/progressConfirmation', function(data) {
                                          $("#loader").html(data["progress"]);
                                      });
                                  }, 1000);
                              });
                          }
                          }, '#paypal-button-container');
                          </script>
  
                          {{-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                              <input type="hidden" name="cmd" value="_s-xclick">
                              <input type="hidden" name="hosted_button_id" value="9VMXDFPYPU7EL">
                              <input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                              <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                          </form> --}}
                          
        </div> <!-- fin del modal -->