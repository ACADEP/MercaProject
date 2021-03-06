
<!-- Footer -->
<div id="footer_div" style=" bottom: 0;">
    <footer class="page-footer" if="footer" id="contact">
        <div style="color:white">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{config('configurations.general.main_logo')}}" width="150px">
                    <p class="white-text text-center"><a href="{{ url('/') }}">{{config('configurations.general.store_name')}}</a></p>
                </div>
                
                <div class="col-md-4 text-center">
                    <address>
                        <ul class="list-unstyled">
                            <li class="footer-sprite address">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    Ignacio Allende #270 col Centro La Paz, BCS, México.
                                </li>
                            <br>
                            <li class="footer-sprite phone">
                                <i class="fa fa-phone"></i>
                                <a href="tel:6121225174">6121225174</a>
                            </li>
                            <br>

                            <li>
                            <i class="fa fa-whatsapp"></i>
                                Whatsapp: <a href="tel:6121225174" target="_blank">6121578112</a>
                            <li><br>

                            <li class="footer-sprite email">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <a href="mailto:ventas@acadep.com">ventas@acadep.com</a>
                            </li>
                        </ul>
                    </address>
                </div>

                 <div class="col-md-4 text-center">
                    <p>Formas de pago</p>
                    <img src="/images/WaystoPays/Mastercard.png">
                    <img src="/images/WaystoPays/Visa.png">
                    <img src="/images/WaystoPays/PayPal.png">
                    <img src="/images/WaystoPays/OXXO.png">
                    <img src="/images/WaystoPays/Dollar.png">
                    <br><br>
                    <a href="{{route("pages.politics")}}">Politicas de privacidad</a> &nbsp;
                    <a href="{{route("pages.terms-and-conditions")}}">Terminos y condiciones</a>
                </div>
                
            </div>
        </div>
        <div class="footer-copyright">
            <div class="text-center"><a href="http://acadep.com/wp/" target="_blank">©{{\Carbon\Carbon::now()->year}} Derechos Reservados, mercadata.com</a></div>
        </div>
    </footer>
</div>
