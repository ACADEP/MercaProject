@extends('app')

@section('content')

<div >
    <div class="row">
        <div class="mt-5 mb-5"><h1>Método de pago</h1></div>
    </div>
    <div class="row mb-3">
       
        <div class="payments" id="accordion" style="width: 100%;">

        <link rel="stylesheet" type="text/css" href="/css/payments.css" data-rel-css="" />
        <script src="https://js.stripe.com/v3/"></script>
        <script src="/js/index-stripe.js" data-rel-js></script>

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
                        size:   'medium',    // medium | large | responsive
                        shape:  'rect',      // pill | rect
                        color:  'gold'       // gold | blue | silver | white | black
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
                        sandbox: 'AYPU5279dmgaIqbbk8_QrxzBk7Cv3HGVh4W_jQhqdugNDlVt8XP7gEC9tqSDRsvwfggevjmQqb-EU9zw',
                        production: '<insert production client id>'
                        },

                        payment: function (data, actions) {
                        return actions.payment.create({
                            payment: {
                            transactions: [
                                {
                                amount: {
                                    total: '0.50',
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

                    </div>
                </div>
                
            </div>

            
        </div>
    </div>
    
    <script>
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
    </script>

</div>



@endsection

