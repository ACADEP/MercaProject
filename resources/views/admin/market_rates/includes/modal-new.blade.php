{{-- Modal para agregar productos a la cotizacion --}}
<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar producto o servicio a la cotización</h1>
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

        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1primary" id="tab1" data-toggle="tab">Produto</a></li>
                        <li><a href="#tab2primary" id="tab2" data-toggle="tab">Servicio</a></li>
                    </ul>
            </div> {{--Fin tab header--}}
        <form  id="form-add-new" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="tab_active" id="tab_active">
            <div class="panel-body">
                <div class="tab-content">
                       <div class="tab-pane fade in active" id="tab1primary">
                        <label for="product_sku">Código SKU: </label>
                        <input type="text" required class="form-control" required name="product_sku" id="product_sku" style="width:100%;" value="">
                        <br>
            
                        <label for="product_name">Nombre del producto: </label>
                        <input type="text" required class="form-control" required name="product_name" id="product_name" style="width:100%;"  value="">
                        <span class="msg-error" style="color:red" id="product_name_error"></span>
                        <br>
            
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="product_price">Precio: </label>
                                <input type="text" required class="form-control product_new_price" required name="product_price" style="width:100%;" id="product_price" value="">
                                <span class="msg-error" style="color:red" id="product_price_error"></span>
                            </div>
                
                            <div class="col-md-6">
                                <label for="product_price">Cantidad: </label>
                                <input type="number" class="form-control" required name="qty_product" id="qty_product" style="width:100%;" min="1" value="1">
                            </div>
            
                        </div>
                       </div> {{--Fin tab 1--}}

                       <div class="tab-pane fade in" id="tab2primary">
                        <label for="summary">Descripción: </label>
                        <textarea class="form-control" required name="summary" id="summary" style="width:100%; height:200px;"></textarea>
                        <span class="msg-error" style="color:red" id="service_summary_error"></span>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="service_price">Precio: </label>
                                <input type="text" required class="form-control product_new_price" required name="service_price" style="width:100%;" id="service_price" value="">
                                <span class="msg-error" style="color:red" id="service_price_error"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="unity">Unidad: </label>
                                <select class="form-control" required id="unity" name="unity">

                                    @foreach (config("enums.unities") as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="qty_service">Cantidad: </label>
                                <input type="number" class="form-control" required name="qty_service" id="qty_service" style="width:100%;" min="1" value="1">
                            </div>

                           
                        </div>
                    
                        
                       </div>

                </div>{{--Fin tab content--}}

            </div> {{--Fin tab body--}}

        </div> {{--Fin Tabs--}}

          
        <br>
        <div class="text-center">
            <button type="button" class="btn btn-success btn-add-newmarket">Agregar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
              
         
        </form>
    </div>
        
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
         $(".product_new_price").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });
    </script>
@endpush