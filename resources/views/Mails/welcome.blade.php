<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>titulo</title>

</head>
<body>
  <h1>Bienvenido a {{ $appName }}</h1>

<p>Se ha registrado un usuario en la plataforma con las siguientes credenciales de acceso:</p>

<ul>
    <li>Usuario: {{ $user->email }}</li>
    <li>Contraseña: {{ $password }}</li>
</ul>


<p>Para acceder visite la URL {{ $appUrl }} e indique sus credenciales de acceso.</p>

<p>Este correo es enviado de manera automática por la aplicación {{ $appName }}.</p>

  </div>
</body>
</html>