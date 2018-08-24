<html>

    <head>
        <script type="text/javascript" src="{{ asset('/js/js.cookie.js') }}"></script>
        <script>
            function cargar(){
              var productos=JSON.parse(Cookies.get('productos'));
              console.log(productos);
              var p=document.getElementById("p");
              p.innerHTML=productos[0].id;
            }
        
        </script>
        
    </head>
    
<body onload="cargar()">
    <div class="col-md-12" style="height:100%; widht=100%;">
            <p id="p"></p>
    
        
    </div>
</body>

</html>





