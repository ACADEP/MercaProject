@extends('app')

@section('content')
<div id="loader-contener"><div id="loader" class='text-center' style='font-size:40px; '><span style="padding-top:300px;">Espere por favor</span> </div></div>
    
<br>
<!-- Stepper -->
<div class="row">
    <div class="col-md-8" >

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible w-100 text-center" role="alert" style="font-size: 18px;">

            <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                @foreach ($errors->all() as $error)
                    <li style="list-style-type: none;">{{ $error }} </li>
                @endforeach
            </ul>
            
        </div>
    @endif
    <div class="content-process">
        <div class="text-center box-process title-process">
            Proceso de pago
        </div>

        <div style="margin-top: 50px;" >
            <div class="steps-form-2" >
                
                <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">

                    <div class="steps-step-2">
                        <a href="#step-1" type="button" class="btn btn-amber btn-circle-2 waves-effect ml-0" data-toggle="tooltip" data-placement="top" title="Dirección"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                    </div>
                
                    @if($rates->count() > 1)
                        {{-- Paqueteria --}}
                        <div class="steps-step-2">
                            <a href="#step-2" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Paquetería"><i class="fa fa-truck" aria-hidden="true"></i></a>
                        </div>
                    @endif

                    <div class="steps-step-2">
                        <a href="#step-3" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Método de pago"><i class="fa fa-usd" aria-hidden="true"></i></a>
                    </div>
                    <div class="steps-step-2">
                        <a href="#step-4" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect mr-0" data-toggle="tooltip" data-placement="top" title="Verificar"><i class="fa fa-check" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Elegir la direccion activa --}}
        @include('cart.includes.address-active')
    
        {{-- Seccion para elegir la paquerteria --}}
        @if($rates->count() > 0)
            @include('cart.includes.shipment-method')
        @endif
    
        <script> $('#loader').remove();</script>
    
        @include('cart.includes.pay-method')
    
        @include('cart.includes.verify')
    
    
    <!-- </form> -->

    </div>

</div>

<div class="col-md-4  container-details">
<!-- Default form contact -->
<form class="text-center">
<div class="box-details">
    <p class="title-details">Detalles de la compra</p>
    <div class="text2-details">
        Cantidad : {{ $cartItems->count() }}<!-- Cantidad -->
    </div>
</div>

   
 <div class="box-details" style="margin-top: 15px;">
    <div class="text2-details" style="padding-top: 15px">
        Total de productos : ${{ number_format($subtotal, 2) }} <br>
        {{-- Envío + impuestos:  --}}
        <div id="ship_rate_choosed" style="display:none;" class="ship-rate">$0,00</div> <br>
      
    </div>
</div>
    
<div class="box-details" style="margin-top: 15px;">
    <div class="text2-details" style="padding-top: 8px; padding-bottom: 8px;">
        <input type="hidden" id="total-cart" value="{{ $subtotal }}">
        Total con envío : <div id="total">${{ number_format($subtotal, 2) }}</div>
        <input type="hidden" id="total-pursh" value="{{$subtotal}}"> 
    </div>
</div>
 
    

</form>
<!-- Default form contact -->
</div>


</div>

@stop

@section('css-pay')
<style>
    .content-process{
    width: 100%;
    height: auto;
    padding: 10px;
    background: #F5F8FA;
    border: 1px solid rgba(0, 0, 0, 0.5);
    box-sizing: border-box;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 8px; 
    }
    .box-process{
        padding: 10px;
        width: 100%;
        height: auto;
        background: #FFFFFF;
        border: 1px solid rgba(0, 0, 0, 0.5);
        box-sizing: border-box;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }
    .title-process{
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 38px;
        line-height: 45px;
    }
    .text2-details{
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        line-height: 23px;
    }
    .container-details{
        
    width: 100%;
    height: auto;
    padding: 10px;
    background: #F5F8FA;
    border: 1px solid rgba(0, 0, 0, 0.5);
    box-sizing: border-box;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 8px;
    }
    .box-details{
        padding: 10px;
        width: 100%;
        height: auto ;
       
        background: #FFFFFF;
        border: 1px solid rgba(0, 0, 0, 0.5);
        box-sizing: border-box;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }
    .title-details{
        font-weight: 600;
        font-size: 24px;
        line-height: 28px;
        
    }
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

    //Notifiaciones de errores
    @if(Session::has('error'))

        $.notify({
            // options
            message: '<strong>{{ Session("error") }}</strong>' 
        },{
            // settings
            type: 'danger',
            delay:3000
        });
  
    @endif

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
        
        function reset_pay_css()
        {
            for(var i=1;i<=5;i++)
            {
                $("#card-pay"+i).css("border", "solid white 1px");
            }
        }
        $("#shipment").html("A acordar con el vendedor");
        // Paqueterias

        //Metodos de pago
        $("#mpay-1").click(function(){
            reset_pay_css();
            $("#card-pay1").css("border", "solid blue 5px");
            $("#pay").html("Débito o crédito");
            $("#credit-debit-method-r").prop("checked",true);
        });

        $("#mpay-2").click(function(){
            reset_pay_css();
            $("#card-pay2").css("border", "solid blue 5px");
            $("#pay").html("PayPal");
            $("#paypal-method-r").prop("checked",true);
        });

        $("#mpay-3").click(function(){
            reset_pay_css();
            $("#card-pay3").css("border", "solid blue 5px");
            $("#pay").html("Tranferencia bancaria");
            $("#bank-method-r").prop("checked",true);
        });

         $("#mpay-4").click(function(){
            reset_pay_css();
            $("#card-pay4").css("border", "solid blue 5px");
            $("#pay").html("Tienda de convenencia");
            $("#store-method-r").prop("checked",true);
        });

         $("#mpay-5").click(function(){
            reset_pay_css();
            $("#card-pay5").css("border", "solid blue 5px");
            $("#pay").html("Oxxo");
            $("#oxxo-method-r").prop("checked",true);
        });
    
        // $("#btn-next-pay")
        $("#btn-conf").click(function(){
            // if(carrie_choosed){
                if($("#credit-debit-method-r").prop("checked"))
                {
                
                        $('#debit-card').modal('show');
                        
                        $("#openpay_carrie").val($("#shipment").html()); //Nombre de la paquetería
                        $("#openpay_carrie_id").val($('#carrie_id').val());
           
                        
                        $("#total-credit").val($("#total-pursh").val());
                        $("#ship_rate_target").val($('#ship_rate_choosed').html());
                        $("#date_ship_target").val($('#date_aprox').html());
                        $('#method_pay_target').val("Tarjeta de débito o crédito");
                    
                
                }
                else if($("#paypal-method-r").prop("checked"))
                {
                    $('#pay-pal').modal('show');
                    $("#paypal-amount").val($("#total-pursh").val());
                    
                } //Transferencia bancaria
                else if($("#bank-method-r").prop("checked"))
                {
                
                    $(".rate_delivered").val($("#total-pursh").val());
                    $("#transfer-total-html").html($("#total-pursh").val());
                    $("#bank_carrie").val($("#shipment").html()); //Nombre de la paquetería
                    $("#method_pay_bank").val("Transferencia bancaria");
                    $("#bank_carrie_id").val($('#carrie_id').val());
                    $("#ship_rate_bank").val($('#ship_rate_choosed').html());
                    $("#date_ship_bank").val($('#date_aprox').html());
                    $('#transfer').modal('show');
                } //Tiendas de convenencia
                else if($("#store-method-r").prop("checked"))
                {
                
                    $(".rate_delivered").val($("#total-pursh").val());
                    $("#store-total-html").html($("#total-pursh").val());
                    $("#store_carrie").val($("#shipment").html()); //Nombre de la paquetería
                    $("#method_pay_store").val("Tiendas de convenencia");
                    $("#store_carrie_id").val($('#carrie_id').val());
                    $("#ship_rate_store").val($('#ship_rate_choosed').html());
                    $("#date_ship_store").val($('#date_aprox').html());
                    $('#store').modal('show');
                }
                else if($("#oxxo-method-r").prop("checked"))
                {
                
                    $(".rate_delivered").val($("#total-pursh").val());
                    $("#oxxo_carrie").val($("#shipment").html()); //Nombre de la paquetería
                    $("#oxxo_carrie_id").val($('#carrie_id').val());
                    $("#ship_rate_oxxo").val($('#ship_rate_choosed').html());
                    $("#date_ship_oxxo").val($('#date_aprox').html());
                    $('#oxxo').modal('show');
                }
                else
                {
                    alert("Elegir un metodo de pago");
                }
            // }
            // else
            // {
            //     alert("Elegir un metodo de envío");
            // }
        });

        $(".loader").fadeOut("slow");
        

    });
</script>
@stop

@push('scripts')

    @include('cart.utils.modal-add-address')

    @include('cart.utils.modal-add-personal')

    <script>

        @if ($errors->any())
            @if(url()->previous()==route('customer.address.add'))
                $("add_address").modal("show");
            @endif
    
        @endif

    </script>
@endpush

@section('scripts-progress')
<script type="text/javascript">
    $(document).ready(function() {
        $('#pay-button').submit(function() {
            // setInterval(function(){
            //     $.getJSON('/progressConfirmation', function(data) {
            //         $("#loader").html(data["progress"]);
            //     });
            // }, 1000);
           
        });
    });
</script>   
@stop

@section('modal-debit')
    @include('cart.includes.modals.credit-debit')
@stop

@section('modal-transfer')
    @include('cart.includes.modals.transfer')
@stop

@section('modal-store')
     @include('cart.includes.modals.store')
@stop

@section('modal-oxxo')
    @include('cart.includes.modals.oxxo')
@stop

@section('modal-paypal')
    @include('cart.includes.modals.pay-pal')
@stop



@section('ajax-shipment')

<script type="text/javascript" src="{{ asset('/js/ajax-shipment.js') }}"></script>
@stop
@section('css-openpay')
    <link rel="stylesheet" href="{{ asset('/css/openpay.css') }}">
@stop