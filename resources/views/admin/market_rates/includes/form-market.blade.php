<div class="row">
    
    
    <div class="col-md-4 text-left">
        <label for="company">Empresa:</label>
        <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="company" id="company" value="{{old('company', $data->company)}}">
        &nbsp&nbsp

    </div>

    <div class="col-md-4 text-left">
    <label for="client">Cliente:</label><br>
    <select required class="form-control" style="width:100%;" name="client" id="client">
        <option value="">Elegir un cliente</option>
        @foreach ($clients as $item)
            <option @if(old("client", $data->client) == $item->id ) selected @endif
             value="{{$item->id}}">{{$item->full_name}}</option>
        @endforeach
        <option value="add">Añadir</option>
    </select>
    {{-- <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="client" id="client" value="{{old('client', $data->client)}}"> --}}
    &nbsp&nbsp
    </div>

    <div class="col-md-4 text-left">
    <label for="contact">Contacto:</label>
    <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="contact" id="contact" value="{{old('contact', $data->contact)}}"> <br> <br>
    &nbsp&nbsp
    </div>

    <div class="col-md-4 text-left">
    <label for="address">Domicilio:</label>
    <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="address" id="address"  value="{{old('address', $data->address)}}">
    &nbsp&nbsp
    </div>

    <div class="col-md-4 text-left">
    <label for="phone">Teléfono:</label>
    <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="phone" id="phone" value="{{old('phone', $data->phone)}}">
    &nbsp&nbsp
    </div>

    <div class="col-md-4 text-left">
    <label for="email">Email:</label>
    <input type="email" class="form-control" required style="width:100%;" maxlength="255" name="email" id="email" value="{{old('email', $data->email)}}">
    </div>
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