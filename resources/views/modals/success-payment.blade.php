<div class="modal fade" id="success-pay" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">

          <h5 class="modal-title"></h5>
          
        </div>
        <div class="modal-body" id="modal-body">

            <div class="col-md-12 text-center" id="title">
                ¡Compra Exitosa!
            </div>

            <div class="col-md-12 text-center" style="top: 10px;">
                <img src="/images/modals/success.png" alt="">
            </div>

            <div class="col-md-12 text-center" style="font-weight: normal; text-aling:justify; top: 25px; ">
              <img src="/images/modals/mano.png" alt=""> &nbsp; {{$msg}}
            </div>
            <div class="col-md-12 text-center" style="font-weight: 600; font-weight: 900; top: 30px;">
              Pago con Tarjeta Débito o Crédito
          </div>
          <div class="col-md-12 text-center" style="top: 30px;">
            <img src="/images/modals/visa.png" alt="">
        </div>
        <div class="col-md-12 text-center" style="top: 30px;">
          <img src="/images/modals/openpay.png" alt="">
      </div>

    {{-- <div class="row col-md-12 text-center " style="top: 30px;">
        <div class="col-md-6" >
          <span style="font-weight: 600;">Fecha: </span>  {{\Carbon\Carbon::now()->format("d/m/Y")}}
        </div>
        <div class="col-md-6">
          <span style="font-weight: 600;">Total: </span> $200.00
        </div>
    </div> --}}

    <div class="col-md-12 text-center " style="top: 30px; font-size:20px;">

       
          <span style="font-weight: 600;">Fecha: </span>  {{\Carbon\Carbon::now()->format("d/m/Y")}}
      
        
    </div>

    <div class="col-md-12 text-center" style="top: 30px;">
        <div  style="margin-top: 29px;">
          <button data-dismiss="modal" id="btn-close" class="botoon">Cerrar</button>
        </div>     
    </div>

         
        </div>
      </div>
    </div>
  </div>

  <style>
      #title{
        position: static;

        font-family: sans-serif;
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        line-height: 33px;
        /* identical to box height, or 137% */

        
        color: #000000;
      }
      .botoon{
        background: #164DCE;
        color: #FFFFFF;
        font-weight: bold;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #000000;
        width: 288px;
        padding: 0x;
        height: 40px;
        }

        #modal-body{
          
          width: 100%;
          height: 510px;
          font-family: Arial, Helvetica, sans-serif;     
          background: #FFFFFF;
          color: #000000;
          box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.12);
          border-radius: 16px !important;
        }
        #modal-content{
          background: #FFFFFF;
          box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.12);
          border-radius: 16px !important;
        }
        
      
  </style>
  