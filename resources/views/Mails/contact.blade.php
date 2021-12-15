@extends('Mails.layout')

@section('content')
  <h1>Mensaje enviado desde {{ $appName }}</h1>

<p>Ha recibido un mensaje, por motivo de {{ $contact['type'] }} indicando lo siguiente:</p>

<ul>
    <li>Nombre: {{ $contact['firstname'] }}</li>
    <li>Apellido: {{ $contact['lastname'] }}</li>
    <li>Correo: {{ $contact['email'] }}</li>
    <li>Telefono: {{ $contact['phone'] }}</li>
    <li>Asunto: {{ $contact['subject'] }}</li>
    <li>Escribenos: {{ $contact['message'] }}</li>
</ul>

<p>Este correo es enviado de manera automática por la aplicación {{ $appName }}.</p>

  </div>
@endsection