@extends('Mails.layout')

@section('content')
  <h1>Mensaje enviado desde {{ $appName }}</h1>

<p>Ha recibido un mensaje, por motivo de display indicando lo siguiente:</p>

<ul>
    <li>Nombre: {{ $data['user']['profile']['firstname'] }}</li>
    <li>Correo: {{ $data['user']['email'] }}</li>
    <li>Telefono: {{ $data['user']['phone'] }}</li>
    @if (!empty($data['city']) && !empty($data['displays']))
      <li>Ciudad de destino: {{ $data['city'] }}</li>
      <li>Displays: {{ count($data['displays']) > 0 ? implode(', ', $data['displays']) : '' }}</li>
    @endif
</ul>

<p>Este correo es enviado de manera automática por la aplicación {{ $appName }}.</p>

  </div>
@endsection