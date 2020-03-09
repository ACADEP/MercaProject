@if(isset($search))
<table class="table text-center" style="width:100%;"> 
<thead>
    <tr>
        <th></th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach($search as $product)
        <tr id="product{{$product->id}}">
        <input type="hidden" id="product_photo{{$product->id}}" value="{{$product->photos()->first() ? $product->photos()->first()->path : '/images/no-image-found.jpg'}}">
            <td class="col-md-1"><img src="{{$product->photos()->first() ? $product->photos()->first()->path : '/images/no-image-found.jpg'}}" style="width:50%;"></td>
            <td >
                <input type="text" class="form-control" id="product_sku{{$product->id}}" style="width:100%;" value="{{$product->product_sku}}">
            </td>

            <td >
                <input type="text" class="form-control" id="product_name{{$product->id}}" style="width:100%;"  value="{{$product->product_name}}">
            </td>

            <td class="form-inline "><input type="text" class="form-control product_price" style="width:100%;" id="product_price{{$product->id}}" value="{{$product->mr_price}}"></td>
            <td >
                <input type="number" class="form-control" id="qty_product{{$product->id}}" style="width:100%;" min="1" value="1">
                {{-- <select class="form-control" id="qty_product{{$product->id}}">
                    @for($i=1;$i<=$product->product_qty;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor --}}
                </select>
            </td>
            <td > 
                
                    <button class="btn btn-primary btn-sm btn-add-market" style="width:100%;" data-toggle="tooltip" title="Agregar" value="{{$product->id}}">
                        <i class="fa fa-plus"></i>
                    </button>
                
            </td>
        </tr>
    @endforeach
</tbody>

</table>

<div class="text-center">
{{ $search->appends(request()->except('page'))->links() }}

</div>
@endif

@push('scripts')
    <script>
         $(".product_price").keydown(function(event) {
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