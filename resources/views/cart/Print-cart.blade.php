<html>

<body>
    <table class="table">
        <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                    
                </tr>
        </thead>
        <tbody>
            @if(Auth::check())
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->product->product_name}}</td>
                        <td>{{$item->product->price}}</td>
                        <td>{{$item->qty }}</td>
                        <td>{{$item->total}}</td>
                    </tr>
                @endforeach
            @else
                @foreach($items as $item)
                <tr>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->price}}</td>
                    <td>1</td>
                    <td>{{$item->price*1}}</td>
                </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>
            
    
        
 
</body>

</html>





