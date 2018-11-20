<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de restablecimiento de contraseña</title>
</head>
<body>

<div>
    <img src="{{asset('/images/logo-home.png')}}">
</div>    

<h1>Recuperación de contraseña!</h1>


<p>
    Solo necesitamos que <a href='{{ url("/password/reset",$user->token) }}'>confirme su correo electrónico</a> gracias!
</p>


</body>
</html>