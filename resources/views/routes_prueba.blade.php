<h5>estas son las rutas para acceder a las pruebas</h5>

<p>vista para revisar el registro de hotel:</p>
Registro de hotel<br>
<a href="{{ route('hotels.create') }}">/hotel/create/</a><br>
prueba de lista de hoteles, con opcion de edicion y eliminacion<br>
<a href="{{ route('hotels.index') }}">/hotel</a>
<br /><br />
<p>registro de admins</p>
<a href="{{ route('admin.create') }}">/admin/create/</a><br>
prueba de lista de admins, ayudantes del cliente, con opcion de edicion y eliminacion<br>
<a href="{{ route('admin.index') }}">/admin</a>