@extends('Mails.layout')

@section('content')
  <h1>Compra en {{ $appName }} Mensaje enviado a Administrador</h1>

  <p>Se ha registrado una compra en la plataforma {{ $appName }}, los productos son:</p>

  <ul>
    @foreach($order->shippings as $product)
      <li>{{ $product->product->title }}</li>
      
    @endforeach
  </ul>

  <h3>Datos de envio:</h3>
  @php
    $shipping = $order->shippings->first()
  @endphp
  <ul>
    <li>Nombre: {{ $shipping->firstname }}</li>
    <li>Corero: {{ $shipping->email }}</li>
    <li>Dirección: {{ $shipping->address  }}</li>
    <li>Habitación o apartamento:{{ $shipping->hab  }}</li>
    <li>Codigo postal: {{ $shipping->zip_code  }}</li>
    <li>Observaciones: {{ $shipping->observations   }}</li>
  </ul>
  <p>Para acceder visite la URL {{ $appUrl }} Y verifique la compra.</p>

  <p>Este correo es enviado de manera automática por la aplicación {{ $appName }}.</p>

  </div>
@endsection