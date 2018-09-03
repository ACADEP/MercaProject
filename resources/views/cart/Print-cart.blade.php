<html>
<head>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div><img src="/images/mercadata-footer.png" width="250px"></div>
    @php $now = new \DateTime(); @endphp
    <div class="text-right">{{$now->format('d-m-Y h:i')}}</div>
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
                        <td>${{number_format($item->product_price, 2) }}</td>
                        <td>{{$item->qty}}</td>
                        <td>${{number_format($item->total, 2)}}</td>
                        @php $totalCart+=$item->total; @endphp
                    </tr>
                @endforeach
            @else
                @foreach($items as $item)
                <tr>
                    @php $total_price=$item->price-$item->reduced_price; @endphp
                    <td>{{$item->product_name}}</td>
                    <td>${{number_format($total_price, 2)}}</td>
                    <td>{{$item->qty}}</td>
                    <td>${{number_format(($total_price*$item->qty), 2)}}</td>
                    @php $totalCart+=$total_price*$item->qty; @endphp
                </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>
    <br>
    <div id="total">Su total es: ${{number_format($totalCart, 2)}}</div>        
    
        
 
</body>

</html>





