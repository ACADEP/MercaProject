<div class="modal fade" id="change_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar Dirección</h1>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('customer.address.add') }}" method="POST" id="paymentForm">
                    {{csrf_field()}}
                    
                    
                    <div class="text-center" style="padding-bottom: 30px;">
                        <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                    
                </form>
            </div>
      
        </div>
    </div>
</div>

