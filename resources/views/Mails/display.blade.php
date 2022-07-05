@extends('Mails.layout')

@section('content')
  <h1>Mensaje enviado desde {{ $appName }}</h1>

<p>Ha recibido un mensaje, por motivo de display indicando lo siguiente:</p>

<ul>
    <li>Nombre: {{ $user->profile->firstname }}</li>
    <li>Correo: {{ $user->email }}</li>
    <li>Telefono: {{ $user->profile->phone }}</li>
</ul>

<p>Este correo es enviado de manera automática por la aplicación {{ $appName }}.</p>

  </div>
@endsection