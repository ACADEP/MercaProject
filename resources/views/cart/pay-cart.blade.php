@extends('app')

@section('content')
<div id="loader-contener"><div id="loader" class='text-center' style='font-size:40px;'>Espere por favor.....</div></div>
    
<br>
<script> </script>
<!-- Stepper -->
<div class="row">
<div class="col-md-8 border" >
    <h2 class="text-center font-bold"><strong>Proceso de pago</strong></h2><br><br>
    <div class="steps-form-2">
        <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">
            <div class="steps-step-2">
                <a href="#step-1" type="button" class="btn btn-amber btn-circle-2 waves-effect ml-0" data-toggle="tooltip" data-placement="top" title="Dirección"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
            </div>
            <div class="steps-step-2">
                <a href="#step-2" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Paquetería"><i class="fa fa-truck" aria-hidden="true"></i></a>
            </div>
            <div class="steps-step-2">
                <a href="#step-3" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Método de pago"><i class="fa fa-usd" aria-hidden="true"></i></a>
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
            @php $i=1;@endphp
                @if($addresses->count() > 0)
                    @if($addresses->count() < 3 )
                        <div class="text-right"><a data-toggle="modal" data-target="#add_address" style="color:blue;">Agregar una dirección</a></div>
                    @endif
                    <h4>Será enviado a:</h4>
                    @foreach($addresses as $address)
                    
                    <div class="border" style="font-size:15px;">
                    <div class="custom-control custom-radio" style="margin-top: 10px;">
                    &nbsp;<input type="radio" class="custom-control-input radio-address" {{ $address->activo==1 ? 'id=defaultChecked checked' : 'id=defaultUnchecked'.$i }} value="{{ $address->id }}"   name="defaultExampleRadios3">
                        <label class="custom-control-label" {{ $address->activo==1 ? 'for=defaultChecked' : 'for=defaultUnchecked'.$i }} >Activar dirección</label>
                    </div>
                    <hr>
                    &nbsp;<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
                    <strong>CP:</strong>{{$address->cp}} <br>
                    <strong>&nbsp;Ciudad:</strong>{{ $address->ciudad }} {{$address->estado}} <br>
                    <strong>&nbsp;Calles:</strong> {{$address->calle}} entre {{ $address->calle2 }} y {{ $address->calle3 }} <br> 
                    <strong>&nbsp;Colonia:</strong> {{ $address->colonia }} <br>
                    <strong>&nbsp;Número exterior:</strong> {{$address->numExterior=="" ? 'No especificado': $address->numExterior}}<br> 
                    <strong>&nbsp;Número interior:</strong> {{$address->numInterior=="" ? 'No especificado': $address->numinterior}} <br>
                    <strong>&nbsp;Referencias: </strong> {{$address->referencias=="" ? 'No especificado': $address->referencias}}
                    </div>
                   
                    <br>

                     @php $i++; @endphp
                    @endforeach
                    
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
            <h3 class="font-weight-bold pl-0 my-4"><strong>Envío</strong></h3>
                <div class="row" id="shipments">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paquetería <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/estafeta.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="paqueteria1" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="paqueteria1"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paquetería <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/dhl.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio" >
                                    <input type="radio" class="custom-control-input" id="paqueteria2" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="paqueteria2"></label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Paquetería <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="/images/shipments/fedex.jpg" style="width:100%;" alt="">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="paqueteria3" name="defaultExampleRadios">
                                    <label class="custom-control-label" for="paqueteria3"></label>
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
                                    <input type="radio" class="custom-control-input" id="paqueteria4" name="defaultExampleRadios" checked>
                                    <label class="custom-control-label" for="paqueteria4"></label>
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
            <h3 class="font-weight-bold pl-0 my-4"><strong>Método de pago</strong></h3>
            <div class="row">
                    <a id="debit-method">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Débito <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/debit-credit.png" style="width:100%;">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio" >
                                    <input type="radio" class="custom-control-input" id="debit-method-r" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="debit-method-r"></label>
                            </div>
                        </div>
                    </div>
                    </a>

                    <a id="credit-method">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Crédito <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/debit-credit.png" style="width:100%;">
                                
                            </p>
                            <br>
                            <div class="custom-control custom-radio" >
                                    <input type="radio" class="custom-control-input" id="credit-method-r" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="credit-method-r"></label>
                            </div>
                        </div>
                    </div>
                    </a>

                    <a id="paypal-method">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">PayPal <br><br></div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/paypal.png" style="width:100%; height:60px;">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="paypal-method-r" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="paypal-method-r"></label>
                                </div>
                        </div>
                    </div>
                    </a>

                    <a id="bank-method">
                    <div class="card border-primary mb-3 text-center col-md-4" style="max-width: 10rem; margin:10px;">
                        <div class="card-header">Tranferencia bancaria</div>
                        <div class="card-body text-primary">
                            <p class="card-text">
                                <img src="images/shipments/transfer.png" style="width:100%; height:60px;">
                                
                            </p>
                            <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="bank-method-r" name="defaultExampleRadios2">
                                    <label class="custom-control-label" for="bank-method-r"></label>
                            </div>
                        </div>
                    </div>
                </div>
                </a>

                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" id="btn-prev-pay" type="button">Anterior</button>
                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" id="btn-next-pay" type="button">Siguiente</button>
            </div>
        </div>

        <!-- Fourth Step -->
        <div class="row setup-content-2" id="step-4">
            <div class="col-md-12">
                <h3 class="font-weight-bold pl-0 my-4"><strong>Verificar compra</strong></h3>
                    <h4> <i class="fa fa-truck fa-lg" aria-hidden="true"></i> Método de envío:</h4>
                    <div id="shipment" style="font-size:15px;"> Seleccionar un método</div>
                    <input type="hidden" id="carrie_id">
                    <br>
                    @if($addresses->count() > 0)
                        @php $address=$addresses->where('activo',1)->first();@endphp
                        @if($address!=null)
                        <h4>Será enviado a:</h4>
                        <input type="hidden" id="address-active" value="{{$address}}">
                        <input type="hidden" id="customer" value="{{ $customer }}">
                        <div class="border" style="font-size:15px;" id="address-ship">
                            &nbsp;<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
                            <strong>CP:</strong>{{$address->cp}} <br>
                            <strong>&nbsp;Ciudad:</strong>{{ $address->ciudad }} {{$address->estado}} <br>
                            <strong>&nbsp;Calles:</strong> {{$address->calle}} entre {{ $address->calle2 }} y {{ $address->calle3 }} <br> 
                            <strong>&nbsp;Colonia:</strong> {{ $address->colonia }} <br>
                            <strong>&nbsp;Número exterior:</strong> {{$address->numExterior=="" ? 'No especificado': $address->numExterior}}<br> 
                            <strong>&nbsp;Número interior:</strong> {{$address->numInterior=="" ? 'No especificado': $address->numinterior}} <br>
                            <strong>&nbsp;Referencias: </strong> {{$address->referencias=="" ? 'No especificado': $address->referencias}}
                        </div>

                        @else
                        <div class="alert alert-danger">Usted no tiene dirección definida </div>
                        @endif
                    @else
                        <div class="alert alert-danger">Usted no tiene dirección definida </div>
                    @endif
                    <br>
                    <h4>Método de pago:</h4>
                    <div id="pay" style="font-size:15px;">Seleccionar un método</div>
                    
                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Anterior</button>
                @if($addresses->count() > 0)
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
        Envío + impuestos: <div id="ship-rate">$0,00</div> <br>
    </div>
    
    <hr>

    <div class="h5">
        <input type="hidden" id="total-cart" value="{{ $subtotal }}">
        Total: <div id="total">${{ number_format($subtotal, 2) }}</div>
        <input type="hidden" id="total-pursh"> 
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
    #loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}

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

        //Metodos de pago
        $("#debit-method").click(function(){
            $("#pay").html("Débito");
        });

        $("#credit-method").click(function(){
            $("#pay").html("Crédito");
        });

         $("#paypal-method").click(function(){
            $("#pay").html("PayPal");
        });

         $("#bank-method").click(function(){
            $("#pay").html("Tranferencia bancaria");
        });
        
        //radio-checked metodos de pago
        $("#credit-method").click(function(){
            $("#credit-method-r").prop("checked",true);
        });
        $("#debit-method").click(function(){
            $("#debit-method-r").prop("checked",true);
        });
        $("#paypal-method").click(function(){
            $("#paypal-method-r").prop("checked",true);
        });
        $("#bank-method").click(function(){
            $("#bank-method-r").prop("checked",true);
        });
        
        // $("#btn-next-pay")
        $("#btn-conf").click(function(){
            if($("#credit-method-r").prop("checked") || $("#debit-method-r").prop("checked"))
            {
                var payment="{{ $customer->paymentactive() }}";
                if(payment=="1")
                {
                    var token=OpenPay.token.create({
                        "card_number":"4111111111111111",
                        "holder_name":"Juan Perez Ramirez",
                        "expiration_year":"20",
                        "expiration_month":"12",
                        "cvv2":"110",
                        "address":{
                            "city":"Querétaro",
                            "line3":"Queretaro",
                            "postal_code":"76900",
                            "line1":"Av 5 de Febrero",
                            "line2":"Roble 207",
                            "state":"Queretaro",
                            "country_code":"MX"
                        }
                    }, onSuccess, onError);
                    var onSuccess = function(response) {
                                    var token_id = response.data.id;
                                    $('#token_id').val(token_id);
                                    $("#loader-contener").html("<div id='loader' class='text-center alert alert-success' style='font-size:40px;'>Espere para completar su compra</div>");
                                    $('#payment-form').submit();
                                };

                    var onError = function(response) {
                                    var desc = response.data.description != undefined ? response.data.description : response.message;
                                    alert("ERROR [" + response.status + "] " + desc);
                                    $("#pay-button").prop("disabled", false);
                                };
                   console.log(token);
                    // post("{{url('/cart/payment/openpay')}}",{_token:"{{csrf_token()}}"   } );
                }
                else
                {
                    $('#debit-card').modal('show');
                    $("#openpay_carrie").val($("#shipment").html()); //Nombre de la paquetería
                    $("#openpay_carrie_id").val($('#carrie_id').val());
                    $("#rate_delivered").val($("#total-pursh").val());
                }
               
            }
            // else if($("#debit-method-r").prop("checked"))
            // {
            //     $('#debit-card').modal('show');
            //     $("#openpay_carrie").val($("#shipment").html());
            //     $("#openpay_carrie_id").val($('#carrie_id').val());
            //     $("#rate_delivered").val($("#total-pursh").val());
                
            // }
            else if($("#paypal-method-r").prop("checked"))
            {
                $('#pay-pal').modal('show');
                $("#paypal-amount").val($("#total-pursh").val());
                
            }
            else if($("#bank-method-r").prop("checked"))
            {
                alert("Metodo en desarollo");
            }
            else
            {
                alert("Elegir un metodo de pago");
            }
        });

        $(".loader").fadeOut("slow");
        

    });
</script>
@stop

@section('modal-debit')
<div class="modal fade" id="debit-card" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="width: 10000px;">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Información de pago</h1>
      </div>
      <div class="modal-body text-center">
       
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
                                    $("#loader-contener").html("<div id='loader' class='text-center alert alert-success' style='font-size:40px;'>Espere para completar su compra</div>");
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
                                    <input type="hidden" name="ship_rate_total" id="rate_delivered">
                                    <input type="hidden" name="carrie" id="openpay_carrie">
                                    <input type="hidden" name="carrie_id" id="openpay_carrie_id">
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
               
      </div> <!-- fin del modal -->
      
    </div>
  </div>
</div>

@stop

@section('modal-paypal')
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
                                $("#loader-contener").html("<div id='loader' class='text-center alert alert-success' style='font-size:40px;'>Espere para completar su compra</div>");
                                post("{{url('/cart/confirmation')}}",{_token:"{{csrf_token()}}" ,carrie: ship, carrie_id: carrie_id  } );
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
@stop

@section('ajax-shipment')
<script type="text/javascript" src="{{ asset('/js/ajax-shipment.js') }}"></script>
@stop
@section('css-openpay')
    <link rel="stylesheet" href="{{ asset('/css/openpay.css') }}">
@stop