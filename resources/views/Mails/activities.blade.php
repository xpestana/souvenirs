@extends('Mails.layout')

@section('content')
  <h1>Compra en {{ $appName }}</h1>

  <p>Se ha registrado una compra en la plataforma {{ $appName }}, los productos son:</p>

  <ul>
    @foreach($order->shippings as $product )
      <li>{{ $product->product->title }}</li>
    @endforeach
  </ul>

  <h3>Datos de envio:</h3>
  @php
    $shipping = $order->shippings->first()
  @endphp
  <ul>
    <li>{{ $shipping->firstname }} {{ $shipping->lastname }}</li>
    <li>{{ $shipping->email }}</li>
    <li>{{ $shipping->address  }}</li>
    <li>{{ $shipping->company  }}</li>
    <li>{{ $shipping->apart  }}</li>
    <li>{{ $shipping->city  }}</li>
    <li>{{ $shipping->state  }}</li>
    <li>{{ $shipping->zip_code  }}</li>
    <li>{{ $shipping->phone   }}</li>
  </ul>
  <p>Para acceder visite la URL {{ $appUrl }} Y verifique la compra.</p>

  <p>Este correo es enviado de manera automática por la aplicación {{ $appName }}.</p>

  </div>
@endsection