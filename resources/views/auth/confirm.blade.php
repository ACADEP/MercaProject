<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Registro</title>
</head>
<body>


<h1>Gracias por registrarte!</h1>


<p>
    Solo necesitamos que <a href='{{ url("register/confirm/{$user->token}") }}'>confirme su correo electrónico</a> gracias!
</p>


</body>
</html>