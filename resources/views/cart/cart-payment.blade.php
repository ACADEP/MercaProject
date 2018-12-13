@extends('app')

@section('content')

<div >
    <div class="row">
        <div class="mt-5 mb-5"><h1>Método de pago</h1></div>
    </div>
    <div class="row mb-3">
       
        <div class="payments" id="accordion" style="width: 100%;">

        <link rel="stylesheet" type="text/css" href="/css/payments.css" data-rel-css="" />
        

            <h1 class="mt-5 mb-3">Método sugerido</h1>
            <div class="card debit-card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Tarjeta de crédito ó débito
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        
                        <form action="/cart/confirmation" method="POST">
                            {{ csrf_field() }}
                            <script
                              src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                              data-key="pk_test_M1U2ifs6hohMw8VJaQWc33Be"
                              data-amount="999"
                              data-name="Mercadata"
                              data-description="Example charge"
                              data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                              data-locale="auto">
                            </script>
                          </form>

                        {{-- <div class="globalContent">
                            <!--Example 2-->
                            
                            <div class="hola cell example example2">
                                <form action="/cart/confirmation" method="post" id="payment-form"> 
                                {{ csrf_field() }}
                                    <div data-locale-reversible>
                                        <div class="row">
                                            <div class="field">
                                                <input id="example2-name" data-tid="elements_examples.form.name_placeholder" class="input empty" type="text" placeholder="Nombre y apellido" required="" autocomplete="name">
                                                <label for="example2-name" data-tid="elements_examples.form.name_label">Titular</label>
                                                <div class="baseline"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field">
                                            <div id="example2-card-number" class="input empty"></div>
                                            <label for="example2-card-number" data-tid="elements_examples.form.card_number_label">Número de tarjeta</label>
                                            <div class="baseline"></div>
                                        </div>
                                    </div>
                                    <div class="row" style="flex-wrap: nowrap;">
                                        <div class="field half-width">
                                            <div id="example2-card-expiry" class="input empty"></div>
                                            <label for="example2-card-expiry" data-tid="elements_examples.form.card_expiry_label">Expiración</label>
                                            <div class="baseline"></div>
                                        </div>
                                        <div class="field half-width">
                                            <div id="example2-card-cvc" class="input empty"></div>
                                            <label for="example2-card-cvc" data-tid="elements_examples.form.card_cvc_label">CVC</label>
                                            <div class="baseline"></div>
                                        </div>
                                    </div>
                                    <button type="submit" data-tid="elements_examples.form.pay_button">Pagar</button>
                                    <div class="error" id="ocultar" role="alert" hidden><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                        <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                        <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                        </svg>
                                        <span class="message"></span>
                                    </div>
                                </form>
                                <div class="success" id="successful" hidden>
                                    <div class="icon">
                                        <svg style="margin-left: 150px; padding-top: 20px;" width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                                        <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                                        </svg>
                                    </div>
                                    <h3 class="title" style="margin-left: 120px; padding-top: 10px;" data-tid="elements_examples.success.title">Pago exitoso</h3>
                                </div>
                            </div>
                        </div> --}}

                        <!-- strippe-->
                    </div>
                </div>

                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            PayPal
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion"> 
                    <div class="card-body">
                        
                        <div id="paypal-button-container"></div>
                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                        <script>
                        // Render the PayPal button
                        paypal.Button.render({
                        // Set your environment
                        env: 'sandbox', // sandbox | production

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
                        sandbox: 'AcbJmhLyQjcEbqe44-pfFrSk3UrV03SwoFSgFgwwoFfiCl8Qjda6ePlsHIyb0nCjzhOQDkUgsya5EHXn',
                        production: '<insert production client id>'
                        },

                        payment: function (data, actions) {
                        return actions.payment.create({
                            payment: {
                            transactions: [
                                {
                                amount: {
                                    total: '10.00',
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
                            window.alert('Payment Complete!');
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
                            


                    </div>
                </div>

                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Pago en Banco
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion"> 
                    <div class="card-body">
                        {{-- <script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script> --}}
                        <form action="/cart/confirmation-banco" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary" formtarget="_blank">Depositar en Bancomer</button>
                        </form>

                    </div>
                </div>

                <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Pago Tiendas de Conveniencia
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion"> 
                    <div class="card-body">
                        <form action="/cart/confirmation-store" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary"  formtarget="_blank">Pagar en Tiendas de Conveniencia</button>
                        </form>
                    </div>
                </div>

                <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Notificaciones OpenPay
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion"> 
                    <div class="card-body">
                        <form action="/notificacions/openpay" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Notificacion</button>
                        </form>    
                    </div>
                </div>
                
                <div class="card-header" id="headingSix">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Notificaciones Paypal
                        </button>
                    </h5>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion"> 
                    <div class="card-body">
                        <form action="/notificacions/paypal" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Notificacion</button>
                        </form>    
                    </div>
                </div>   
                
                <div class="card-header" id="headingSeven">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Tarjeta de credito o debito OpenPay
                        </button>
                    </h5>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion"> 
                    <div class="card-body">

                        <script type="text/javascript">
                            $(document).ready(function() {

                                /*OpenPay.setId('mk5lculzgzebbpxpam6x');
                                OpenPay.setApiKey('pk_26757cbb5f7f44e8b31a2aed751c285c');
                                OpenPay.setSandboxMode(true);*/
                                //Se genera el id de dispositivo
                                var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
                                
                                $('#pay-button').on('click', function(event) {
                                    event.preventDefault();
                                    $("#pay-button").prop( "disabled", true);
                                    OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);                
                                });

                                var sucess_callbak = function(response) {
                                var token_id = response.data.id;
                                $('#token_id').val(token_id);
                                $('#payment-form').submit();
                                };

                                var error_callbak = function(response) {
                                    var desc = response.data.description != undefined ? response.data.description : response.message;
                                    alert("ERROR [" + response.status + "] " + desc);
                                    $("#pay-button").prop("disabled", false);
                                };

                            });
                        </script>

                        <div class="bkng-tb-cntnt">
                            <div class="pymnts">
                                <form action="/cart/payment/openpay" method="POST" id="payment-form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="token_id" id="token_id">
                                    <div class="pymnt-itm card active">
                                        <h2>Tarjeta de crédito o débito</h2>
                                        <div class="pymnt-cntnt">
                                            <div class="card-expl">
                                                <div class="credit"><h4>Tarjetas de crédito</h4></div>
                                                <div class="debit"><h4>Tarjetas de débito</h4></div>
                                            </div>
                                            <div class="sctn-row">
                                                <div class="sctn-col l">
                                                    <label>Nombre del titular</label><input type="text" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name">
                                                </div>
                                                <div class="sctn-col">
                                                    <label>Número de tarjeta</label><input type="text" autocomplete="off" data-openpay-card="card_number"></div>
                                                </div>
                                                <div class="sctn-row">
                                                    <div class="sctn-col l">
                                                        <label>Fecha de expiración</label>
                                                        <div class="sctn-col half l"><input type="text" placeholder="Mes" data-openpay-card="expiration_month"></div>
                                                        <div class="sctn-col half l"><input type="text" placeholder="Año" data-openpay-card="expiration_year"></div>
                                                    </div>
                                                    <div class="sctn-col cvv"><label>Código de seguridad</label>
                                                        <div class="sctn-col half l"><input type="text" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2"></div>
                                                    </div>
                                                </div>
                                                <div class="openpay"><div class="logo">Transacciones realizadas vía:</div>
                                                <div class="shield">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
                                            </div>
                                            <div class="sctn-row">
                                                    <a class="button rght" id="pay-button">Pagar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> 

                <div class="card-header" id="headingEight">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            Agregar Cliente Openpay
                        </button>
                    </h5>
                </div>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion"> 
                    <div class="card-body">

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
                            <fieldset>
                                <legend>Datos del cliente</legend>
                            <p>
                                <label>Nombre</label>
                                <input type="text" size="20" autocomplete="on" name="client_name"/>
                            </p>
                            <p>
                                <label>Correo Electr&oacute;nico</label>
                                <input type="text" size="20" autocomplete="on" name="cliente_email"/>
                            </p>
                            </fieldset>
                            <fieldset>
                                <legend>Datos de la tarjeta</legend>
                            <p>
                                <label>Nombre</label>
                                <input type="text" size="20" autocomplete="off"
                                data-openpay-card="holder_name" />
                            </p>
                            <p>
                                <label>N&uacute;mero</label>
                                <input type="text" size="20" autocomplete="off"
                                data-openpay-card="card_number" />
                            </p>
                            <p>
                                <label>CVV2</label>
                                <input type="text" size="4" autocomplete="off"
                                data-openpay-card="cvv2" />
                            </p>
                            <p>
                                <label>Fecha de expiraci&oacute;n (MM/YY)</label>
                                <input type="text" size="2" data-openpay-card="expiration_month" /> /
                                <input type="text" size="2" data-openpay-card="expiration_year" />
                            </p>
                            </fieldset>
                            <input type="submit" id="save-button" value="Pagar"/>
                        </form>

                    </div>
                </div> 
                
                <div class="card-header" id="headingNine">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            Pago en Bancomer u Oxxo
                        </button>
                    </h5>
                </div>
                <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion"> 
                    <div class="card-body">
                        <form action="/cart/payment/pruevaOxxo" method="get">
                            {{ csrf_field() }}
                            <input type="hidden" name="Items" id="items-carts">
                            <button type="submit" class="btn btn-primary" formtarget="_blank">Pagar</button>
                        </form>    
                    </div>
                </div>   
                
            </div>

            
        </div>
    </div>
    
    {{-- <script>
        //stripe
        var elements = stripe.elements({
              fonts: [
                {
                  cssSrc: 'https://fonts.googleapis.com/css?family=Source+Code+Pro',
                },
              ],
              // Stripe's examples are localized to specific languages, but if
              // you wish to have Elements automatically detect your user's locale,
              // use `locale: 'auto'` instead.
            });

            // Floating labels
            var inputs = document.querySelectorAll('.cell.example.example2 .input');
            Array.prototype.forEach.call(inputs, function(input) {
              input.addEventListener('focus', function() {
                input.classList.add('focused');
              });
              input.addEventListener('blur', function() {
                input.classList.remove('focused');
              });
              input.addEventListener('keyup', function() {
                if (input.value.length === 0) {
                  input.classList.add('empty');
                } else {
                  input.classList.remove('empty');
                }
              });
            });

            var elementStyles = {
              base: {
                color: '#32325D',
                fontWeight: 500,
                fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
                fontSize: '16px',
                fontSmoothing: 'antialiased',

                '::placeholder': {
                  color: '#CFD7DF',
                },
                ':-webkit-autofill': {
                  color: '#e39f48',
                },
              },
              invalid: {
                color: '#E25950',

                '::placeholder': {
                  color: '#FFCCA5',
                },
              },
            };

            var elementClasses = {
              focus: 'focused',
              empty: 'empty',
              invalid: 'invalid',
            };

            var cardNumber = elements.create('cardNumber', {
              style: elementStyles,
              classes: elementClasses,
            });
            cardNumber.mount('#example2-card-number');

            var cardExpiry = elements.create('cardExpiry', {
              style: elementStyles,
              classes: elementClasses,
            });
            cardExpiry.mount('#example2-card-expiry');

            var cardCvc = elements.create('cardCvc', {
              style: elementStyles,
              classes: elementClasses,
            });
            cardCvc.mount('#example2-card-cvc');
            
            registerElements([cardNumber, cardExpiry, cardCvc], 'example2');
    </script> --}}


</div>



@endsection

@section('css-openpay')
    <link rel="stylesheet" href="{{ asset('/css/openpay.css') }}">
@stop