  <!-- Third Step -->
  <div class="row setup-content-2" id="step-3">
    <div class="col-md-12">
    <h3 class="col-md-8 elige-title"><strong>Elige un método de pago</strong></h3>
    <div class="row col-md-12" >
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <a id="mpay-1">
            <div class="card border-primary mb-3 text-center col-md-2  card-sizes" id="card-pay1" >
                <div class="box-method text-size" style="padding: 0">Débito o crédito</div>
                <div class="card-body text-primary">
                    <div>
                        <img src="images/shipments/debit-credit.png" class="img-pay">
                    </div>
                   
                    <div class="custom-control custom-radio" >
                            <input type="radio" class="custom-control-input" id="credit-debit-method-r" name="defaultExampleRadios2">
                            <label class="custom-control-label" for="credit-debit-method-r"></label>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <a id="mpay-2">
            <div class="card border-primary mb-3 text-center col-md-2  card-sizes" id="card-pay2" >
                <div class=" box-method text-size" style="padding-top:10px; padding-bottom:10px;">PayPal </div>
                <div class="card-body text-primary">
                    <div>
                        <img src="images/shipments/paypal.png" class="img-pay">
                        
                    </div>
                    <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="paypal-method-r" name="defaultExampleRadios2">
                            <label class="custom-control-label" for="paypal-method-r"></label>
                        </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <a id="mpay-3">
            <div class="card border-primary mb-3 text-center col-md-2 card-sizes" id="card-pay3" >
                <div class="box-method text-size2"style="padding: 0">Tranferencia bancaria</div>
                <div class="card-body text-primary">
                   <div>
                       <img src="images/shipments/transfer.png" class="img-pay">
                   </div>
                        
                   
                    <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="bank-method-r" name="defaultExampleRadios2">
                            <label class="custom-control-label" for="bank-method-r"></label>
                    </div>
                </div>
            </div>
     
        </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <a id="mpay-4">
                <div class="card border-primary mb-3 text-center col-md-2 card-sizes" id="card-pay4" >
                    <div class="box-method text-size3" style="padding: 0">Tiendas de conveniencia </div>
                    <div class="card-body text-primary">
                        <div>
                            <img src="images/shipments/store.png" class="img-pay"> 
                        </div>
                        <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="store-method-r" name="defaultExampleRadios2">
                                <label class="custom-control-label" for="store-method-r"></label>
                        </div>
                    </div>
                </div>
           
            </a>
        </div>

        <!-- <a id="mpay-5" style="width: 24%;">
            <div class="card border-primary mb-3 text-center col-md-2" id="card-pay5" style="max-width: 10rem; margin:10px; height:250px;">
                <div class="card-header">Oxxo</div>
                <div class="card-body text-primary">
                    <p class="card-text">
                        <img src="images/shipments/oxxo.png" style="width:100%;">
                        
                    </p>
                    <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="oxxo-method-r" name="defaultExampleRadios2">
                            <label class="custom-control-label" for="oxxo-method-r"></label>
                    </div>
                </div>
            </div>
            </a> -->
        </div>
       
        <button class="buttonx btn btn-mdb-color btn-rounded prevBtn-2 float-left" id="btn-prev-pay" type="button">Anterior</button>
        <button class="buttonx btn btn-mdb-color btn-rounded nextBtn-2 float-right" id="btn-next-pay" type="button">Siguiente</button>
    </div>
</div>

@push('styles')
<style>
    .buttonx{
       background-color:#2659d1 !important;
   }
   .card-sizes{
    max-width: inherit;
    margin:10px; 
    height:200px;
   }
   .img-pay{
    height: 50px;
    width: 100%;
    object-fit: contain;
}
.text-size{
    font-style: normal;
    font-weight: normal;
    font-size: 20px;
    line-height: 23px;
}
.text-size2{
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 23px;
}
.text-size3{
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 23px;
    
}
.elige-title{
                font-weight: 600;
                font-size: 30px;
                line-height: 40px;
                color: #4F4F4F;
            }
.box-method{
        float: initial;
        padding: 5px;
        width: 100%;
        height: auto;
        background: #ffffff;
      
        box-sizing: border-box;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }
</style>
    
@endpush