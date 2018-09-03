<html>

<body>
    <div><img src="/images/mercadata-footer.png" width="250px"></div>
    @php $now = new \DateTime(); @endphp
    <div>{{$now->format('d-m-Y h:i')}}</div>
    <table class="table">
       @php $totalCart=0;@endphp
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
                        <td>{{$item->qty}}</td>
                        <td>{{$item->total}}</td>
                        @php $totalCart+=$item->total; @endphp
                    </tr>
                @endforeach
            @else
                @foreach($items as $item)
                <tr>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->price*$item->qty}}</td>
                    @php $totalCart+=$item->price*$item->qty; @endphp
                </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>
    <br>
    <div id="total">Su total es: ${{$totalCart}}</div>        
    
        
 
</body>

</html>





