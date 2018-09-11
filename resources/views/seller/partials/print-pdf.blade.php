<html>
<head>
    <!-- <link rel="stylesheet" href="{{asset('/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
     -->
     <title>Historial de ventas</title>
     <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div><img src="{{asset('/images/mercadata-footer.png')}}" width="250px"></div>
    @php $now = new \DateTime(); @endphp
    <div class="text-right">{{$now->format('d-m-Y h:i')}}</div>
<table class="table text-center">
    <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre del producto</th>
                <th>Precio unt</th>
                <th>Cliente</th>
                <th>Fecha de la venta</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
      
            @foreach($seleHistories as $history)
                <tr>
                    <td ><img  src="{{url( $history->product->photos->first()->path)}}"  height="30px"></td>
                    <td>{{ $history->product->product_name }}</td>
                    <td>${{number_format($history->product->price, 2)}}</td>
                    <td>{{ $history->client }}</td>
                   
                    <td>{{ $history->date}}</td>
                    <td>{{ $history->amount }}</td>
                    <td>${{number_format($history->total, 2)  }}</td>
                </tr>
            @endforeach
       
        </tbody>
    
    </table>

</body>
</html>