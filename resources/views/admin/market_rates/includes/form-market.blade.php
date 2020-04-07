<div class="row">
    
    
    <div class="col-md-4 text-left">
        <label for="company">Empresa:</label>
        <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="company" id="company" value="{{old('company', $data->company)}}">
        &nbsp&nbsp

    </div>

    <div class="col-md-4 text-left">
    <label for="client">Cliente:</label>
    <input type="text" class="form-control" required style="width:100%;" maxlength="255" name="client" id="client" value="{{old('client', $data->client)}}">
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