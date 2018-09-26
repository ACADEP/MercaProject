@extends('app')

@section('content')
<h2 class="text-center font-bold"><strong>Proceso de pago</strong></h2><br><br>

<!-- Stepper -->
<div class="row">
<div class="col-md-8 border" >
    <div class="steps-form-2">
        <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">
            <div class="steps-step-2">
                <a href="#step-1" type="button" class="btn btn-amber btn-circle-2 waves-effect ml-0" data-toggle="tooltip" data-placement="top" title="Dirección"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
            </div>
            <div class="steps-step-2">
                <a href="#step-2" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Paqueteria"><i class="fa fa-truck" aria-hidden="true"></i></a>
            </div>
            <div class="steps-step-2">
                <a href="#step-3" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Metodo de pago"><i class="fa fa-usd" aria-hidden="true"></i></a>
            </div>
            <div class="steps-step-2">
                <a href="#step-4" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect mr-0" data-toggle="tooltip" data-placement="top" title="Verificar"><i class="fa fa-check" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>

    <!-- First Step -->
    <!-- <form role="form" action="" method="post"> -->
        <div class="row setup-content-2" id="step-1">
            <div class="col-md-12">
                    <!-- incio strippe -->
                    <div class="globalContent">
                            <!--Example 2-->
                            <div class="hola cell example example2">
                                <form action="#" method="post" id="payment-form"> 
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
                            </div>
                        </div>
                        <!-- strippe-->
                    
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" type="button">Siguiente</button>
            </div>
        </div>

    <!-- Second Step -->
        <div class="row setup-content-2" id="step-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paqueteria 1</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/estafeta.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paqueteria 2</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/dhl.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <div class="custom-control custom-radio" >
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked2" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked2"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paqueteria 3</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/fedex.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked3" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked3"></label>
                                </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Acuerdo con el vendedor</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/vendedor.png" style="width:100%;" alt="">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultChecked" name="defaultExampleRadios" checked>
                                    <label class="custom-control-label" for="defaultChecked"></label>
                            </div>
                        </div>
                    </div>
                </div>
                

                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Anterior</button>
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" type="button">Siguiente</button>
            </div>
        </div>

        <!-- Third Step -->
        <div class="row setup-content-2" id="step-3">
            <div class="col-md-12">
            <div class="row">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Debito</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <i class="fa fa-credit-card-alt fa-3x" aria-hidden="true"></i>
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Credito</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <i class="fa fa-credit-card fa-3x" aria-hidden="true"></i>
                                
                            </p>
                            <div class="custom-control custom-radio" >
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked2" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked2"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Pay Pal</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <i class="fa fa-cc-paypal fa-3x" aria-hidden="true"></i>
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked3" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked3"></label>
                                </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Tranferencia bancaria</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <i class="fa fa-exchange fa-3x" aria-hidden="true"></i
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultChecked" name="defaultExampleRadios" checked>
                                    <label class="custom-control-label" for="defaultChecked"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Anterior</button>
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" type="button">Siguiente</button>
            </div>
        </div>

        <!-- Fourth Step -->
        <div class="row setup-content-2" id="step-4">
            <div class="col-md-12">
                <h3 class="font-weight-bold pl-0 my-4"><strong>Finish</strong></h3>
                <h2 class="text-center font-weight-bold my-4">Registration completed!</h2>
                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Previous</button>
                <button class="btn btn-success btn-rounded float-right" type="submit">Submit</button>
            </div>
        </div>
    <!-- </form> -->
</div>

<div class="col-md-4">
<!-- Default form contact -->
<form class="text-center border">

    <p class="h4 mb-4">Detalles de la compra</p>
    <div>
        Descripcion del producto <br>
        Cantidad: 1<!-- Cantidad -->
    </div>

    <hr>

    <div>
        Producto: $0,000,000 <br>
        Envio+inpuestos: $0,00 <br>
    </div>
    
    <hr>

    <div>
        Total: $0,000,00
    </div>
    
 
    

</form>
<!-- Default form contact -->
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
              locale: window.__exampleLocale
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
@stop

@section('css-pay')
<style>
    .steps-form-2 {
    display: table;
    width: 100%;
    position: relative; }
.steps-form-2 .steps-row-2 {
    display: table-row; }
.steps-form-2 .steps-row-2:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 2px;
    background-color: #7283a7; }
.steps-form-2 .steps-row-2 .steps-step-2 {
    display: table-cell;
    text-align: center;
    position: relative; }
.steps-form-2 .steps-row-2 .steps-step-2 p {
    margin-top: 0.5rem; }
.steps-form-2 .steps-row-2 .steps-step-2 button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important; }
.steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 {
    width: 70px;
    height: 70px;
    border: 2px solid #59698D;
    background-color: white !important;
    color: #59698D !important;
    border-radius: 50%;
    padding: 22px 18px 15px 18px;
    margin-top: -22px; }
.steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2:hover {
    border: 2px solid #4285F4;
    color: #4285F4 !important;
    background-color: white !important; }
.steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 .fa {
    font-size: 1.7rem; }
</style>
@stop

@section('js-pay')
<script>
// Tooltips Initialization
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Steppers
$(document).ready(function () {
  var navListItems = $('div.setup-panel-2 div a'),
          allWells = $('.setup-content-2'),
          allNextBtn = $('.nextBtn-2'),
          allPrevBtn = $('.prevBtn-2');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-amber').addClass('btn-blue-grey');
          $item.addClass('btn-amber');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allPrevBtn.click(function(){
      var curStep = $(this).closest(".setup-content-2"),
          curStepBtn = curStep.attr("id"),
          prevStepSteps = $('div.setup-panel-2 div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

          prevStepSteps.removeAttr('disabled').trigger('click');
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content-2"),
          curStepBtn = curStep.attr("id"),
          nextStepSteps = $('div.setup-panel-2 div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i< curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepSteps.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel-2 div a.btn-amber').trigger('click');
});

       
</script>
@stop