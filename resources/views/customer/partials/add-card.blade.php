<div class="modal fade" id="add_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar tarjeta de crédito o débito</h1>
      </div>
      <div class="modal-body">
      <link rel="stylesheet" type="text/css" href="/css/payments.css" data-rel-css="" />
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                @foreach ($errors->all() as $error)
                    <li style="list-style-type: none;">{{ $error }} </li>
                @endforeach
            
            </ul>
            
        </div>
        @endif
        <script src="https://js.stripe.com/v3/"></script>
        <div class="cell example example2">
            <form action="{{ route('customer.payments.add') }}" method="POST" name="newcards">
                {{csrf_field()}}
                <div class="row">
                    <div class="field">
                        <div id="example2-card-number" class="input empty"></div>
                        <label for="example2-card-number" data-tid="elements_examples.form.card_number_label">Número de tarjeta</label>
                        <div class="baseline"></div>
                    </div>
                </div>
                <div data-locale-reversible>
                    <div class="row">
                        <div class="field">
                            <input id="example2-name" data-tid="elements_examples.form.name_placeholder" class="input empty" type="text" placeholder="Nombre y apellido" required="" autocomplete="name">
                            <label for="example2-name" data-tid="elements_examples.form.name_label">Titular</label>
                            <div class="baseline"></div>
                        </div>
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
                <div class="text-center">
                    <div class="btnadd">                    
                    <button type="submit" data-tid="elements_examples.form.pay_button">Aceptar</button>
                    </div>
                    <div class="btnclose">                    
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <div class="error" id="ocultar" role="alert" hidden><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                    <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                    <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                    </svg>
                    <span class="message"></span>
                </div>
            </form>
        </div>
    </div>

      <script>
        var stripe = Stripe('pk_test_M1U2ifs6hohMw8VJaQWc33Be');

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

                // var elements = [cardNumber, cardExpiry, cardCvc];
                // var exampleName = 'example2';

            function registerElements(elements, exampleName) {
                var formClass = '.' + exampleName;
                var example = document.querySelector(formClass);

                var form = example.querySelector('form');
                var error = form.querySelector('.error');
                var errorMessage = error.querySelector('.message');

                function enableInputs() {
                    Array.prototype.forEach.call(
                    form.querySelectorAll(
                        "input[type='text']"
                    ),
                    function(input) {
                        input.removeAttribute('disabled');
                    }
                    );
                }

                function disableInputs() {
                    Array.prototype.forEach.call(
                    form.querySelectorAll(
                        "input[type='text']"
                    ),
                    function(input) {
                        input.setAttribute('disabled', 'true');
                    }
                    );
                }

                function triggerBrowserValidation() {
                    // The only way to trigger HTML5 form validation UI is to fake a user submit
                    // event.
                    var submit = document.createElement('input');
                    submit.type = 'submit';
                    submit.style.display = 'none';
                    form.appendChild(submit);
                    submit.remove();
                }

                // Listen for errors from each Element, and show error messages in the UI.
                var savedErrors = {};
                elements.forEach(function(element, idx) {
                    element.on('change', function(event) {
                    if (event.error) {
                        error.classList.add('visible');
                        savedErrors[idx] = event.error.message;
                        errorMessage.innerText = event.error.message;
                        document.getElementById('ocultar').hidden = false;
                    } else {
                        savedErrors[idx] = null;

                        // Loop over the saved errors and find the first one, if any.
                        var nextError = Object.keys(savedErrors)
                        .sort()
                        .reduce(function(maybeFoundError, key) {
                            return maybeFoundError || savedErrors[key];
                        }, null);

                        if (nextError) {
                        // Now that they've fixed the current error, show another one.
                        errorMessage.innerText = nextError;
                        } else {
                        // The user fixed the last error; no more errors.
                        error.classList.remove('visible');
                        document.getElementById('ocultar').hidden = true;
                        }
                    }
                    });
                });

                // Listen on the form's 'submit' handler...
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Trigger HTML5 validation UI on the form if any of the inputs fail
                    // validation.
                    var plainInputsValid = true;
                    Array.prototype.forEach.call(form.querySelectorAll('input'), function(
                    input
                    ) {
                    if (input.checkValidity && !input.checkValidity()) {
                        plainInputsValid = false;
                        return;
                    }
                    });
                    if (!plainInputsValid) {
                    triggerBrowserValidation();
                    return;
                    }

                    // // Show a loading screen...
                    example.classList.add('submitting');

                    // Disable all inputs.
                    disableInputs();

                    // Gather additional customer data we may have collected in our form.
                    var name = form.querySelector('#' + exampleName + '-name');
                    var additionalData = {
                    name: name ? name.value : undefined,
                    };


                    function enviar (numcard, titular, expiracion, cvc) {                        
                        var card = form.querySelector('#example2' + '-numerotarjeta');
                        var numerotarjeta = card.value;
                        numerotarjeta.value = numcard;

                        var name = form.querySelector('#example2' + '-name');
                        var nombretitular = name.value;
                        nombretitular.value = titular;
                        alert(name.value);

                        var vigencia = form.querySelector('#example2' + '-card-expiry');
                        var fechaexpiracion = vigencia.value;
                        fechaexpiracion.value = expiracion;

                        var codigocvc = form.querySelector('#example2' + '-card-cvc');
                        var codigoseguridad = codigocvc.value;
                        codigoseguridad.value = cvc;

                        // enviar el formulario
                        document.formulario_porcentaje.submit();
                        }



                    // Use Stripe.js to create a token. We only need to pass in one Element
                    // from the Element group in order to create a token. We can also pass
                    // in the additional customer data we collected in our form.
                    
                    // stripe.createToken(elements[0], additionalData).then(function(result) {
                    // // Stop loading!
                    // example.classList.remove('submitting');

                    // if (result.token) {
                    //     // If we received a token, show the token ID.
                    //     //example.querySelector('.token').innerText = result.token.id;
                    //     // stripeTokenHandler(result.token);
                    //     example.classList.add('submitted');

                    //     document.getElementById('successful').hidden = false;
                    //     document.getElementById('payment-form').hidden = true;

                    //     setTimeout(function() {
                    //     form.submit();        
                    //     }, 5000)

                    //     // alert(result.token);
                    // } else {
                    //     // Otherwise, un-disable inputs.
                    //     enableInputs();
                    // }
                    // });

                });
                }

                
      </script>
      
    </div>
  </div>
</div>

