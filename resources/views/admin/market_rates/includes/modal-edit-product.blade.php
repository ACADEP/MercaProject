<div class="modal fade" id="modal-edit-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center" id="exampleModalLongTitle">Editar producto</h1>
        </div>
        <div class="modal-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                        @foreach ($errors->all() as $error)
                            <li style="list-style-type: none;">{{ $error }} </li>
                        @endforeach
                    
                    </ul>
                    
                </div>
            @endif

              <form action="{{route('edit-detail-marketRates')}}" method="POST" id="modal-form">
              {{csrf_field()}} 
              <input type="hidden" name="detail" id="detail_id">
             <div class="row">
                  <div class="col-md-6" style="margin-bottom:5px;">
                     <img id="product_image" style="max-height:80px; object-fit: contain;">
                  </div>

                  <div class="col-md-6 text-right">
                    <button type="button" id="accept-modal"  class="btn btn-success">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>

                 <div class="col-md-12">
                     <label for="prod_market_sku">Sku: </label>
                     <input type="text" class="form-control" id="prod_market_sku" name="product_sku" style="width:100%;">
                 </div>

                 <div class="col-md-12">
                     <label for="prod_market_name">Descripcion: </label>
                     <textarea type="text" cols="30" rows="10" class="form-control" id="prod_market_name" name="product_name" style="width:100%;">
                    </textarea>
                 </div>
              
                
  
               
                <div class="col-md-6">
                <label for="prod_market_price">Precio: </label>
                <input type="text" class="form-control" style="width:100%;" id="prod_market_price_format" >
                <input type="hidden" class="form-control" name="product_price" style="width:100%;" id="prod_market_price" >
                </div>
    
                <div class="col-md-6">
                <label for="prod_market_price">Cantidad: </label>
                <input type="number" class="form-control" name="product_qty" id="prod_market_qty" style="width:100%;" min="1">
                </div>
             </div>
             
              
              
             
             
              
            
              
          
            </form>
          
        </div>
        
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
        //Servicios
    //Establecer el precio formateado en el input price_format donde se ingresa al cantidad
    function setFormatPriceMarket(input_val){
        var num= input_val.replace(/\,/g,'');
        if(num.length>0)
        {
            $("#prod_market_price").val(num); //Input escondido 
            var format =num.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $("#prod_market_price_format").val( format );
        }
    }
   
    
    //Establecer el precio formateado cuando se esta ingresando
    $('#prod_market_price_format').keyup(function(e) {
        setFormatPriceMarket($(this).val());
    });
    //Validacion de solo ingresar numeros y un punto para formatearlo
    $('#prod_market_price_format').keypress(function(e) {
        if (e.which != 8 && e.which != 0 && e.which!=46 && (e.which < 48 || e.which > 57)) 
        { return false; }
        else
        {
            if(e.which==44)
            {
                return false;
            }
            else if(e.which==46)
            {
                if(this.value.split('.').length>=2)
                {
                    return false;
                }
            }
        }  
        
    });
    </script>      
  @endpush