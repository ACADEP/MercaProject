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
            <h3 class="font-weight-bold pl-0 my-4"><strong>Dirección</strong></h3>
                @if($address != null)
                
                    <div class="text-right"><a href="{{ url('/customer/address') }}" style="color:blue;">Cambiar de dirección</a></div>
                    
                    <h4>Sera enviado a:</h4>
                    <div class="border" style="font-size:23px;"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <strong>CP:</strong>{{$address->cp}} <strong>Ciudad:</strong>{{ $address->ciudad }} {{$address->estado}} <br>
                    <strong>Calles:</strong> {{$address->calle}} entre {{ $address->calle2 }} y {{ $address->calle3 }} Colonia: {{ $address->colonia }}

                    </div>
                    
                @else
                    <a href="{{ url('/customer/address') }}" style="color: blue;">Agregar una dirección</a>
                    <div class="alert alert-danger">Usted no tiene dirección definida </div>
                    
                @endif
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" type="button">Siguiente</button>
            </div>
        </div>

    <!-- Second Step -->
        <div class="row setup-content-2" id="step-2">
            <div class="col-md-12">
            <h3 class="font-weight-bold pl-0 my-4"><strong>Envio</strong></h3>
                <div class="row">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paqueteria <br><br></div>
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
                        <div class="card-header">Paqueteria <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/dhl.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio" >
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked2" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked2"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paqueteria <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/fedex.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked3" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="defaultUnchecked3"></label>
                                </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">A acordar con el vendedor</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/vendedor.png" style="width:100%; height:65px;" alt="">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultChecked" name="defaultExampleRadios" checked>
                                    <label class="custom-control-label" for="defaultChecked"></label>
                            </div>
                        </div>
                    </div>
                </div>
                

                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Anterior</button>
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" id="btn-next-ship" type="button">Siguiente</button>
            </div>
        </div>

        <!-- Third Step -->
        <div class="row setup-content-2" id="step-3">
            <div class="col-md-12">
            <h3 class="font-weight-bold pl-0 my-4"><strong>Metodo de pago</strong></h3>
            <div class="row">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Débito <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/debit-credit.png" style="width:100%;">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked4" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="defaultUnchecked4"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Crédito <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/debit-credit.png" style="width:100%;">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio" >
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked5" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="defaultUnchecked5"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">PayPal <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/paypal.png" style="width:100%; height:60px;">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked6" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="defaultUnchecked6"></label>
                                </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Tranferencia bancaria</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/transfer.png" style="width:100%; height:60px;">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultUnchecked7" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="defaultUnchecked7"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" id="btn-prev-pay" type="button">Anterior</button>
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" id="btn-next-pay" type="button">Siguiente</button>
            </div>
        </div>

        <!-- Fourth Step -->
        <div class="row setup-content-2" id="step-4">
            <div class="col-md-12">
                <h3 class="font-weight-bold pl-0 my-4"><strong>Verificar compra</strong></h3>
                    <h4> <i class="fa fa-truck fa-lg" aria-hidden="true"></i> Metodo de envio:</h4>
                    <div id="shipment" style="font-size:15px;"> Seleccionar un metodo</div>
                    <br>
                    @if($address != null)
                        <h4>Sera enviado a:</h4>
                        <div class="border" style="font-size:15px;"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <strong>CP:</strong>{{$address->cp}} <strong>Ciudad:</strong>{{ $address->ciudad }} {{$address->estado}} <br>
                        <strong>Calles:</strong> {{$address->calle}} entre {{ $address->calle2 }} y {{ $address->calle3 }} Colonia: {{ $address->colonia }}
                        </div>
                    @else
                        <a href="{{ url('/customer/address') }}" style="color: blue;">Agregar una direccion</a>
                        <div class="alert alert-danger">Usted no tiene dirección definida </div>
                    @endif
                    <br>
                    <h4><i class="fa fa-usd" aria-hidden="true"></i> Metodo de pago:</h4>
                    <div id="pay" style="font-size:15px;">Seleccionar un metodo</div>
                    
                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Anterior</button>
                @if($address != null)
                    <button class="btn btn-success btn-rounded float-right" id="btn-conf"type="submit">Confirmar</button>
                @endif
                
                
            </div>
        </div>
    <!-- </form> -->
</div>

<div class="col-md-4">
<!-- Default form contact -->
<form class="text-center border">

    <p class="h4 mb-4">Detalles de la compra</p>
    <div class="h5">
        Cantidad: {{ $cartItems->count() }}<!-- Cantidad -->
    </div>

    <hr>

    <div class="h5">
        Total de productos: ${{ number_format($subtotal, 2) }} <br>
        Envio + inpuestos: $0,00 <br>
    </div>
    
    <hr>

    <div class="h5">
        Total: ${{ number_format($subtotal, 2) }}
    </div>
    
 
    

</form>
<!-- Default form contact -->
</div>


</div>

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

@section('show-modal')
<script>
    $(function() {
        $("#shipment").html("A acordar con el vendedor");
        // Paqueterias
        $("#defaultChecked").click(function(){
            $("#shipment").html("A acordar con el vendedor");
        });

        //Metodos de pago
        $("#defaultUnchecked4").click(function(){
            $("#pay").html("Débito");
        });

        $("#defaultUnchecked5").click(function(){
            $("#pay").html("Crédito");
        });

         $("#defaultUnchecked6").click(function(){
            $("#pay").html("PayPal");
        });

         $("#defaultUnchecked7").click(function(){
            $("#pay").html("Tranferencia bancaria");
        });
        
        // $("#btn-next-pay")
        $("#btn-conf").click(function(){
            if($("#defaultUnchecked4").prop("checked"))
            {
                $('#debit-card').modal('show');
              
            }
            else if($("#defaultUnchecked5").prop("checked"))
            {
                $('#debit-card').modal('show');
                
            }
            else if($("#defaultUnchecked6").prop("checked"))
            {
                alert("Metodo en desarollo");
                
            }
            else if($("#defaultUnchecked7").prop("checked"))
            {
                alert("Metodo en desarollo");
            }
            else
            {
                alert("Elegir un metodo de pago");
            }
        });

    });
</script>
@stop

@section('modal-debit')
<div class="modal fade" id="debit-card" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Información de pago</h1>
      </div>
      <div class="modal-body text-center">
             <!-- incio strippe -->
             <div class="globalContent">
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
                        </div>
                        <!-- strippe-->
                        
      </div> <!-- fin del modal -->
      
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
