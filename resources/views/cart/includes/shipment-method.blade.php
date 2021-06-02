<!-- Second Step -->
<div class="row setup-content-2" id="step-2">
    <div class="col-md-12">
    <h3 class="font-weight-bold pl-0 my-4"><strong>Elige un método de envío</strong></h3>
       
    
    
    <div class="container" id="shipments">
            <!-- Paqueterias disponibles -->
            @if($rates!=null)
                @if($rates->count() > 0)
                 
                @foreach($rates as $rate)
                @if (count((array)$rate)>1)
                        @php $date = date_create($rate->estimated_delivery); @endphp

                
        <div class="row">
            <a  id='paq-{{$loop->iteration}}'>

             <div class="'card border-primary mb-3 text-center col-md-4" id='card-body{{$loop->iteration}}'>
            
                <div class="card" style="width: 10rem; height: 240px;">
               
                <div style="width: 100%">
                    <img src='{{$rate->carrier_logo_url}}' class='img-fluid' style="width: 80px">
                </div>
                    <div class="card-body">
                        <h5 class="card-title">Costo:</h5>
                        <div>${{$rate->total_amount}}</div>
                      <div>
                          Llegada aprox:
                          <div>{{date_format($date, 'd-m-Y')}}</div>
                      </div>

    
                <input type='radio' class='custom-control-input' value="{{$rate->carrier_service_code}}" id='paqueteria{{$loop->iteration}}' name='defaultExampleRadios'>
                 <label class='custom-control-label' for='paqueteria{{$loop->iteration}}'></label>
                       
                    </div>
                    
             </div>   
        </div>
                </a>

        </div>

                        

                        <script>
                            $('#paq-{{$loop->iteration}}').click(function(){
                                carrie_choosed=true;
                                var total_amount=parseFloat("{{$rate->total_amount}}");
                                var total=parseFloat($("#total-cart").val());
                                reset_paq_css();
                                $("#card-body{{$loop->iteration}}").css("border", "solid blue 5px");
                                
                                $('#paqueteria{{$loop->iteration}}').prop("checked",true);
                                var num = '$' + (total_amount).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                $(".ship-rate").html(num);
                                $("#total-pursh").val(total_amount+total);
                                $("#shipment").html("{{$rate->carrier}}");
                                num = '$' + (total_amount+total).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                $("#total").html(num);
                                $('#carrie_id').val($('#paqueteria{{$loop->iteration}}').val());
                                $("#date_aprox").html("{{date_format($date, 'd-m-Y')}}");
                            });
                        </script>
                    @endif
                    @endforeach

                    <script>
                        function reset_paq_css()
                        {
                            for(var i=1;i<="{{$rates->count()}}";i++)
                            {
                                $("#card-body"+i).css("border", "solid white 1px");
                            }
                        }
                    </script>
                @else
                    <span class="alert alert-danger col-md-12">No hay paqueterías disponibles vuelva a intentarlo mas tarde</span>
                @endif
                @else
                <span class="alert alert-danger col-md-12">Primero agregue una dirección para cargar paqueterías</span>
                @endif
            <script> $('#loader').remove();</script>
        </div>
       

        <button class="buttonx btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Anterior</button>
        <button class="buttonx btn btn-mdb-color btn-rounded nextBtn-2 float-right" id="btn-next-ship" type="button">Siguiente</button>
    </div>
</div>

<style>
     .buttonx{
        background-color:#2659d1 !important;
    }

</style>