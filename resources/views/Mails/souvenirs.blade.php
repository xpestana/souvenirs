<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
</head>
<body style="margin: 0;">
    <div class="main" style="padding: 0 2em;">
        <section id="cabecera">
            <div class="container-logo" style="display: flex;flex-direction: column;">
                <!--<img src="{{asset('/vendor_asset/img/logo/hilogo.png')}}" alt="logo" style="margin: 1em auto;max-width: 12em;">--> 

                <img src="http://test.hicitty.com/vendor_asset/img/logo/hilogo.png" alt="logo" style="margin: 1em auto;max-width: 12em;">
            </div>

            <div class="titulo" style="display: flex;flex-direction: column;">
                <h2 style="margin: 1em auto 0.5em auto;text-align: center">Compra realizada con éxito</h2>
            </div>
            <div class="titulo" style="display: flex;flex-direction: column;">
            <!--<img src="{{asset('/vendor_asset/img/mailclient.png')}}" alt="tituloimagen" style="margin: 0 auto;" width="100%"> -->
            <img src="http://test.hicitty.com/vendor_asset/img/mailclient.png" alt="tituloimagen" style="margin: 0 auto;" width="100%">

            </div>
            @php
            $shipping = $order->shippings->first();
            @endphp
            <div style="margin-top: 10px;">
            <h4 style="margin:0;">Hola:  {{ $shipping->firstname }}</h4>
            <p>¡Gracias por tu compra! Tu pedido se ha realizado con éxito y te llegará en un breve.</p>
            </div>
        </section>

        <section id="productos" style="background-color: #f1f1f161;padding: 10px 15px;">  
            <h3 style="margin:0;">Souvenirs</h3>
            @foreach($order->shippings as $product)
                <div class="tarjeta" style="background-color: #ededed;display: flex; flex-direction: row;padding: 8px; margin-top: 0.7em;">
                <img src="{{asset('/vendor_asset/img/recurso_3.png')}}" alt="souvenir" style="width: 7em;height: 5em;">
                <div class="descripcion" style="margin-left: 1em;display: flex; flex-direction: column;">
                    <h4 style="margin:0;">{{ $product->product->title }}</h4>
                    <div class="cantidad" style="margin-top:auto; ">
                    <p style="display: inline;margin:0 2px;">Cantidad</p>
                    <input type="text" style="width: 3em;height: 1.5em;border: 1px solid #dbdbdb;border-radius: 5px;outline:none;">
                    </div>
                </div>
                <div class="precio" style="margin: 0 2em;">
                    <h4 style="margin:0;">{{ $shipping->amount }} €</h4>
                </div>
                </div>
            @endforeach
            <div class="total" style="display: flex;flex-direction: row;color:#9c9c9c;">
                <div class="resumen" style="margin-top: 1em;text-align: center;">
                <p style="margin:0;">Resumen del pedido</p>
                <p style="margin:0;">({{$order->shippings->count()}} {{($order->shippings->count() != 1) ? " artículos" : "articulo" }})</p>
                </div>
                <div class="totales" style="text-align: right;margin-top: 1em;margin-left: auto;">
                <p style="margin:0;">Subtotal: {{ $order->total }}€</p>
                <p style="margin:0;">Costes del envio: {{ $order->shipping }}€</p>
                <p style="color:black;margin:0;">Total Souvenirs: {{ $order->total_s }}€</p>
                </div>
            </div>
        </section>

        <section id="social" style="padding: 15px 0;text-align: center;">
            <p style="text-align:left;">Puedes seguir el estado de tu pedido aquí</p>
            <button style="padding: 8px 30px;margin: 15px 0;border: none;background-color: #0092ff;color: #fff;border-radius: 5px;font-weight: bolder;">Seguimiento del pedido</button>
            <div class="redes">
            <a target="_blank" href="https://www.instagram.com/hicitty_/" class="">
                <img src="/vendor_asset/img/icons/igicon.png" class="px-2" style="width: 2.4em;">
            </a>
            <a target="_blank" href="https://twitter.com/hicitty_" class="" >
                <img src="/vendor_asset/img/icons/twicon.png" class="px-2" style="width: 2.4em;">
            </a>
            <a target="_blank" href="https://www.linkedin.com/company/kognos-vb/" class="" >
                <img src="/vendor_asset/img/icons/inicon.png" class="px-2" style="width: 2.4em;">
            </a>
            </div>
        </section>

        <section id="pie">
            <div class="hicitty" style="text-align: center;background-color: #ebebeb;padding: 16px 8px; ">
            <h5 style="margin: 0;">HiCitty</h5>
            <p style="font-size:10px;margin: 0;">Sevila, 41001, Sevilla</p>
            </div>
        </section>
    </div>
</body>
</html>