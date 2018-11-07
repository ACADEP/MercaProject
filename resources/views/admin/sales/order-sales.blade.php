<div class="row">
    <div class="col-md-1">
    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Ordenar
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="background-color: black;">
        <li><a href="{{url('admin/sales/7') }}">Todos</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{{url('admin/sales/1') }}">Mas vendido</a></li>
        <li><a href="{{url('admin/sales/2') }}">Vendidos reciente</a></li>
        <li><a href="{{url('admin/sales/3') }}">Precio mas alto</a></li>
        <li><a href="{{url('admin/sales/4') }}">Productos de A-Z</a></li>
        <li><a href="{{url('admin/sales/5') }}">Clientes de A-Z</a></li>
        <li><a href="{{url('admin/sales/6') }}">Mayor total</a></li>
        
        
    </ul>
    </div>

    <div class="col-md-3 form-inline" >
        <form action="{{url('admin/sales/orderDate')}}" method="POST">
            {{csrf_field()}}
            <div class="dropdown " style="display: inline;">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Año
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check" aria-labelledby="dropdownMenu2" style="background-color: black;">
                    <li><label for="one"><input type="checkbox" name="año[]" value="2018" id="one" />2018</label></li>
                    <li><label for="two"><input type="checkbox" name="año[]" value="2017" id="two" />2017</label></li>
                    <li><label for="tree"><input type="checkbox" name="año[]" value="2016" id="tree" />2016</label></li>
                    <li><label for="four"><input type="checkbox" name="año[]" value="2015" id="four" />2015</label></li>
                    <!-- <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li> -->
                </ul>
            </div>
            <div class="dropdown " style="display: inline;">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Mes
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check scrollable-menu" aria-labelledby="dropdownMenu3" style="background-color: black;">
                    <li><label for="one"><input type="checkbox" name="mes[]" value="1" id="one" />Enero</label></li>
                    <li><label for="two"><input type="checkbox" name="mes[]" value="2"  id="two" />Febrero</label></li>
                    <li><label for="tree"><input type="checkbox" name="mes[]" value="3"  id="tree" />Marzo</label></li>
                    <li><label for="four"><input type="checkbox" name="mes[]" value="4"  id="four" />Abril</label></li>
                    <li><label for="five"><input type="checkbox" name="mes[]" value="5"  id="five" />Mayo</label></li>
                    <li><label for="six"><input type="checkbox" name="mes[]" value="6"  id="six" />Junio</label></li>
                    <li><label for="seven"><input type="checkbox" name="mes[]" value="7"  id="seven" />Julio</label></li>
                    <li><label for="seven"><input type="checkbox" name="mes[]" value="8"  id="seven" />Agosto</label></li>
                    <li><label for="nine"><input type="checkbox" name="mes[]" value="9"  id="nine" />Septiembre</label></li>
                    <li><label for="ten"><input type="checkbox" name="mes[]" value="10"  id="ten" />Octubre</label></li>
                    <li><label for="eleven"><input type="checkbox" name="mes[]" value="11"  id="eleven" />Noviembre</label></li>
                    <li><label for="twelve"><input type="checkbox" name="mes[]" value="12"  id="twelve" />Diciembre</label></li>
                    <!-- <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li> -->
                </ul>
            </div>
            
            <div class="dropdown" style="display: inline;" size="5">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    dia
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check scrollable-menu"  role="menu" aria-labelledby="dropdownMenu4" style="background-color: black; height: auto; max-height: 150px; overflow-x: hidden;">
                    <li><label for="one"><input type="checkbox" name="dia[]" value="1" id="one" />1</label></li>
                    <li><label for="two"><input type="checkbox" name="dia[]" value="2" id="two" />2</label></li>
                    <li><label for="tree"><input type="checkbox" name="dia[]" value="3" id="tree" />3</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="4" id="four" />4</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="5" id="four" />5</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="6" id="four" />6</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="7" id="four" />7</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="8" id="four" />8</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="9" id="four" />9</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="10" id="four" />10</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="11" id="four" />11</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="12" id="four" />12</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="13" id="four" />13</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="14" id="four" />14</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="15" id="four" />15</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="16" id="four" />16</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="17" id="four" />17</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="18" id="four" />18</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="19" id="four" />19</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="20" id="four" />20</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="21" id="four" />21</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="22" id="four" />22</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="23" id="four" />23</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="24" id="four" />24</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="25" id="four" />25</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="26" id="four" />26</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="27" id="four" />27</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="28" id="four" />28</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="29" id="four" />29</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="30" id="four" />30</label></li>
                    <li><label for="four"><input type="checkbox" name="dia[]" value="31" id="four" />31</label></li>
                    <!-- <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li> -->
                </ul>
            </div>
            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search fa-lg" style="width: 20px;" aria-hidden="true"></i></button>

        </form>
        
    </div>
    @if($histories->count()>0)
    <div class="col-md-2 text-left">
        @php 
            $idHistories=array();
            $total=0;
            foreach($histories as $history)
            {
                array_push($idHistories,$history->id);
                $total+=$history->total;
            }
        @endphp
        <form action="{{ url('/print_pdf_seller') }}" method="get" style="display:inline;">
            <input type="hidden" name="histories" value="{{implode( ", ", $idHistories)}}">
            <button class="btn btn-danger" data-toggle="tooltip" title="Descargar PDF" formtarget="_blank" type="submit">
                <i class="fa fa-print fa-lg" aria-hidden="true"></i>
            </button>
        </form>
            
        <form action="{{ url('/print_excel_seller') }}" method="get" style="display:inline;">
            <input type="hidden" name="histories" value="{{implode( ", ", $idHistories)}}">
            <button class="btn btn-success" data-toggle="tooltip" title="Descargar Excel"  type="submit">
                <i class="fa fa-table fa-lg" aria-hidden="true"></i>
            </button>
        </form>
    </div>
   
    <div class="text-right" style="margin-right:10px;">
       <h4><strong>Total:</strong> <span class="label label-success">${{ number_format($total, 2) }}</span></h4>      
    </div>
    @endif
    
  
</div>
