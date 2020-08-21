<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu1"> <i class="fa fa-info" aria-hidden="true"></i> Informacion general</a></li>
    <li><a data-toggle="tab" href="#menu2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Configurar PDF</a></li>
  </ul>

  <div class="tab-content">

    {{-- Infomacion general --}}
    <div id="menu1" class="tab-pane fade in active">
        <div class="row" style="padding: 5px;">
                <div class="col-md-4 text-left">
                    <label for="company">Empresa:</label>
                    <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="company" id="company" value="{{old('company', $data->company)}}" placeholder="Ingresa un nombre de la empresa">
                    &nbsp&nbsp
            
                </div>
            
                <div class="col-md-4 text-left">
                <label for="client">Cliente:</label><br>
                <select required class="form-control" style="width:100%;" name="client" id="client">
                    <option value="">Elegir un cliente</option>
                    @foreach ($clients as $item)
                        <option @if(old("client", $data->customer ? $data->customer->id : "") == $item->id ) selected @endif
                        value="{{$item->id}}">{{$item->full_name}}</option>
                    @endforeach
                    <option value="add">Añadir</option>
                </select>
                {{-- <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="client" id="client" value="{{old('client', $data->client)}}"> --}}
                &nbsp&nbsp
                </div>
            
                <div class="col-md-4 text-left">
                <label for="contact">Contacto:</label>
                <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="contact" id="contact" value="{{old('contact', $data->contact)}}" placeholder="Ingresar un nombre de contacto"> <br> <br>
                &nbsp&nbsp
                </div>
            
                <div class="col-md-4 text-left">
                <label for="address">Domicilio:</label>
                <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="address" id="address"  value="{{old('address', $data->address)}}" placeholder="Ingresar un domicilio">
                &nbsp&nbsp
                </div>
            
                <div class="col-md-4 text-left">
                <label for="phone">Teléfono:</label>
                <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="phone" id="phone" value="{{old('phone', $data->phone)}}" placeholder="Ingresar un número de telefono">
                &nbsp&nbsp
                </div>
            
                <div class="col-md-4 text-left">
                <label for="email">Email:</label>
                <input type="email" class="form-control" required style="width:100%;" maxlength="255" name="email" id="email" value="{{old('email', $data->email)}}" placeholder="Ingresa un correo electronico">
                </div>
            </div>
    
    </div> {{--Fin--}}

    {{-- Configurar PDF --}}
    <div id="menu2" class="tab-pane fade">
        <div class="row" style="padding: 5px;">
            <div class="col-md-6">
                <label for="time_delivery">Tiempo de entrega:</label>
                <input type="time_delivery" class="form-control" style="width:100%;" maxlength="255" name="time_delivery" id="time_delivery" 
                    value="{{old('time_delivery', $data->timedelivery)}}" placeholder="Ingresa un correo electronico">
            </div>

            <div class="col-md-6">
                <label for="conditions">Condiciones de pago:</label>
                <input type="conditions" class="form-control" style="width:100%;" maxlength="255" name="conditions" id="conditions" 
                    value="{{old('conditions', $data->conditions)}}" placeholder="Ingresa un correo electronico">
            </div>

            <div class="col-md-12" style="margin-top: 15px;">
                <label for="">Notas:</label>
            </div>
            
            <div class="col-md-4">
                <input type="text" class="form-control" style="width:100%;" maxlength="255" name="note[]" id="conditions" 
                    value="{{$data->notes[0]}}" placeholder="Ingresa la nota 1">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" style="width:100%;" maxlength="255" name="note[]" id="conditions" 
                    value="{{$data->notes[1]}}" placeholder="Ingresa la nota 2">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" style="width:100%;" maxlength="255" name="note[]" id="conditions" 
                    value="{{$data->notes[2]}}" placeholder="Ingresa la nota 3">
            </div>

        </div>
    </div> {{--Fin--}}
    
  </div>



@push('scripts')
    <script>
        $("#client").change(function(){
            if( $(this).val() == "add" )
            {
                //Ir a crear un cliente
                window.open('/admin/clients/showcreate', '_blank');
                $(this).val("");
                return ;
            }
            if($(this).val() != "")
            {
                var element_id=$(this).val();
                $.ajax({
                url: "/customer/getdata",
                method: 'get',
                datatype: "json",
                data: {customer_id:element_id},
                    success: function(response){
                        $("#phone").val(response.telefono)
                        $("#address").val(response.full_address)
                        $("#email").val(response.email)
                    },
                    error: function(response) {
                        alert(response)
                    }
                });
            }
        });
    </script>
@endpush