<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*Controladores*/
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UtilitiesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\Products\SouvenirsController;
use App\Http\Controllers\Products\ActivitiesController;
use App\Http\Controllers\Products\CategoriesController;
use App\Http\Controllers\Products\CartController;
use App\Http\Controllers\Admin\RyderController;
use App\Http\Controllers\Ryders\ShippingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



/*Controladores COLLABORATORS*/
use App\Http\Controllers\Collaborator\CollaboratorController;
use App\Http\Controllers\Collaborator\ProfileCollaboratorController;
use App\Http\Controllers\Collaborator\AssociateController;

/*
|---------------------------------------------fff-----------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
    STATICS PAGE
 */
Route::get('/', [UtilitiesController::class, 'home'])->name('home');
Route::get('/tienda/actividades', [UtilitiesController::class, 'activities'])->name('activities');
Route::get('/tienda/souvenirs', [UtilitiesController::class, 'souvenirs'])->name('souvenirs');
Route::get('/quienes-somos', [UtilitiesController::class, 'about'])->name('about.us');
Route::get('/contactanos', [UtilitiesController::class, 'contact'])->name('contact');
Route::post('/contactanos/send', [UtilitiesController::class, 'contact_mail'])->name('contact.send');
Route::get('/souvenir/{product}/show', [ProductsController::class, 'souvenirs'])->name('product.souvenir.show');
Route::get('/activities/{product}/show', [ProductsController::class, 'activities'])->name('product.activities.show');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.destroy');
Route::get('politicas/terminosycondiciones',function(){
    return Inertia::render('Collaborator/Politicas/Terminos'); 
})->name('terminosycondiciones');
Route::get('politicas/privacidad',function(){
    return Inertia::render('Collaborator/Politicas/Privacidad'); 
})->name('privacidad');
Route::get('politicas/devolucion',function(){
    return Inertia::render('Collaborator/Politicas/Reembolso'); 
})->name('devolucion');
Route::get('politicas/entregas',function(){
    return Inertia::render('Collaborator/Politicas/Entregas'); 
})->name('entregas');
Route::get('/politicas/avisolegal',function(){
    return Inertia::render('Collaborator/Politicas/AvisoLegal'); 
})->name('avisolegal');
Route::get('/politicas/cookies',function(){
   return Inertia::render('Collaborator/Politicas/Cookies'); 
})->name('cookies');
/*
    Auth
 */

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

/*
        Cart and sales
     */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/activity/cart/', [CartController::class, 'activity'])->name('cart.activity');

    Route::resource(
        '/checkout',
        CartController::class, [
            'names' => [
                'create'    => 'cart.create',
                'edit'      => 'cart.edit',
                'show'      => 'cart.show',
                'store'     => 'cart.store',
                'update'    => 'cart.update',
                'destroy'   => 'cart.destroy',
            ],
            ['except' => ['index']]
        ],
    ); 

    Route::get('/store/form-checkout', [SalesController::class, 'form_checkout'])->name('form.checkout.souvenirs');
    Route::get('/store/checkout', [SalesController::class, 'checkout'])->name('checkout.souvenirs');
    Route::post('/purchase/redsys', [SalesController::class, 'sale_redsys'])->name('redsys');
    Route::post('/purchase/sale', [SalesController::class, 'sale'])->name('sale');
    Route::post('/sale/activities', [SalesController::class, 'sale_activities'])->name('sale.activities');
    Route::get('/purchase', [SalesController::class, 'purchase'])->name('purchase');


/*
    Dashboard Admin
 */
Route::middleware(['auth', 'verified', 'role:Admin'])->prefix('tablero')->group(function () {
    /*
        Hoteles
    */
    Route::resource(
        '/hotel',
        HotelController::class, [
            'names' => [
                'index'     => 'hotels.index',
                'create'    => 'hotels.create',
                'edit'      => 'hotels.edit',
                'show'      => 'hotels.show',
                'store'     => 'hotels.store',
                'destroy'   => 'hotels.destroy',
            ],
            ['except' => ['update']]
        ],
    );
    Route::post('/update/hotel', [HotelController::class, 'update'])->name('hotels.update');

    /*
        Admins
     */
    

    /*
        Souvenirs
     */
    Route::post('/update/souvenirs', [SouvenirsController::class, 'update'])->name('update.souvenirs');
    Route::post('/souvenirs/image', [SouvenirsController::class, 'image'])->name('souvenirs.image');
    Route::post('/souvenirs/update/image', [SouvenirsController::class, 'updt_image'])->name('souvenirs.update.image');

    Route::resource(
        '/souvenirs',
        SouvenirsController::class, [
            'names' => [
                'index'     => 'souvenirs.index',
                'edit'      => 'souvenirs.edit',
                'create'    => 'souvenirs.create',
                'show'      => 'souvenirs.show',
                'store'     => 'souvenirs.store',
                'destroy'   => 'souvenirs.destroy',
            ],
            ['except' => ['update']]
        ],
    );

    /*
        Activities
     */
    Route::post('/verify/activities', [ActivitiesController::class, 'verify'])->name('verify.activities');
    Route::post('/update/activities/{activities}', [ActivitiesController::class, 'update'])->name('update.activities');
    Route::post('/updt/activities/{activities}', [ActivitiesController::class, 'updt'])->name('updt.activities');
    Route::post('/destroy/activities/', [ActivitiesController::class, 'destroy'])->name('destroy.activities');
    Route::post('/activities/image', [ActivitiesController::class, 'image'])->name('activities.image');
    Route::post('/activities/update/image', [ActivitiesController::class, 'updt_image'])->name('activities.update.image');
    Route::get('/activities/{id}/{page}', [ActivitiesController::class, 'edit'])->name('activities.edit');
    Route::resource(
        '/actividades',
        ActivitiesController::class, [
            'names' => [
                'index'     => 'activities.index',
                'create'    => 'activities.create',
                'show'      => 'activities.show',
                'store'     => 'activities.store',
                'update'    => 'activities.update',
                'destroy'   => 'activities.destroy',
            ],
        ],
    )->except(['edit']);

    /*
        Categorias
     */
    Route::resource(
        '/categorias',
        CategoriesController::class, [
            'names' => [
                'index'     => 'categories.index',
                'edit'      => 'categories.edit',
                'create'    => 'categories.create',
                'show'      => 'categories.show',
                'store'     => 'categories.store',
                'update'    => 'categories.update',
                'destroy'   => 'categories.destroy',
            ],
        ],
    );
    /*
        Ventas
     */
    Route::get('/compras/admin', [SalesController::class, 'sale_admin'])->name('purchases.admin');

    /*
        Ryders
     */
    
    Route::resource(
        'ryders',
        RyderController::class, [
            'names' => [
                'index'     => 'ryders.index',
                'create'    => 'ryders.create',
                'edit'      => 'ryders.edit',
                'show'      => 'ryders.show',
                'store'     => 'ryders.store',
                'update'     => 'ryders.update',
                'destroy'   => 'ryders.destroy',
            ]
        ],
    );
});

Route::get('/shoppings/show/{order}', [SalesController::class, 'purchase_show'])->name('purchase.show');
/*
    Dashboard Común
*/
Route::middleware(['auth', 'verified'])->prefix('tablero')->group(function () {
    /*
        Profile
     */
    Route::resource(
        '/perfil',
        ProfileController::class, [
            'names' => [
                'index'     => 'profile.index',
                'create'    => 'profile.create',
                'edit'      => 'profile.edit',
                'show'      => 'profile.show',
                'store'     => 'profile.store',
                'update'    => 'profile.update',
                'destroy'   => 'profile.destroy',
            ],
        ],
    ); 

    Route::get('/download/qr', [UtilitiesController::class, 'qr'])->name('qr.download');
    Route::get('/compras/hotel', [SalesController::class, 'sale_hotel'])->name('purchases.hotel');
});
Route::middleware(['auth', 'verified', 'role:Ryder'])->prefix('tablero')->group(function () {
    /*
        Ryders
     */
    Route::resource(
        'shippings',
        RyderController::class, [
            'names' => [
                'index'     => 'shippings.index',
                'create'    => 'shippings.create',
                'edit'      => 'shippings.edit',
                'show'      => 'shippings.show',
                'store'     => 'shippings.store',
                'update'    => 'shippings.update',
                'destroy'   => 'shippings.destroy',
            ],
        ],
    ); 
    Route::get('/envios/pendientes', [ShippingController::class, 'pending'])->name('shipping.pending');
    Route::get('/tomar/envio/{order}', [ShippingController::class, 'take'])->name('shipping.take');
    Route::get('/envios/', [ShippingController::class, 'my'])->name('shipping.my');
    Route::get('/envios/finish/{order}', [ShippingController::class, 'finish'])->name('shipping.finish');
});
/******************Colaboradores*******************/

/*Static Page*/
Route::get('/colaboradores', function(){
    return Inertia::render('Collaborator/Home');
})->name('collaborator.home');

/*Auth*/

Route::get('/colaboradores/registro', [CollaboratorController::class, 'create'])->name('collaborator.register');  
Route::post('/register/collaborator', [CollaboratorController::class, 'store'])->name('register.collaborator');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('registro/datos', [CollaboratorController::class, 'data'])->name('collaborator.data');  
    Route::post('register/data', [CollaboratorController::class, 'register_data'])->name('collaborator.register.data');
    Route::post('/borrar-cuenta/{id}', [ProfileCollaboratorController::class, 'destroy'])->name('collaborator.delete');  
});

/*Dashboard Colaborador*/
Route::middleware(['auth', 'verified'])->prefix('tablero/alojamientos')->group(function () {
    
    Route::get('/', [CollaboratorController::class, 'index'])->name('collaborator.index');  
    Route::get('/crear', [CollaboratorController::class, 'create_hab'])->name('collaborator.create.hab');  
    Route::post('/store', [CollaboratorController::class, 'store_hab'])->name('collaborator.store.hab');
    Route::get('/edit/{hab}',[CollaboratorController::class, 'edit_hab'])->name('collaborator.edit.hab');
    Route::post('/update/{id}',[CollaboratorController::class, 'update_hab'])->name('collaborator.update.hab');    
    Route::get('/hab-ventas/{hab}', [CollaboratorController::class, 'sales_hab_details'])->name('collaborator.sales.details');  
    Route::get('/ventas/totales/{id}', [CollaboratorController::class, 'sales_hab'])->name('collaborator.sales.hab');  

});


/*Dashboard Colaborador*/
Route::middleware(['auth', 'verified'])->prefix('tablero/')->group(function () {
    
    Route::get('/', [CollaboratorController::class, 'home'])->name('collaborator.dashboard.home'); 
    Route::get('/perfil-informacion', [CollaboratorController::class, 'profile_info'])->name('dashboard.profile.info'); 
    Route::get('/perfil', [CollaboratorController::class, 'profile'])->name('collaborator.dashboard.profile');   
    
});
/*Dashboard asociados*/
Route::middleware(['auth', 'verified'])->prefix('tablero/asociado/')->group(function () {
    
    Route::get('/servicios', [ProfileCollaboratorController::class, 'associate_profile'])->name('associates.index');  
    Route::get('/ajustes', [ProfileCollaboratorController::class, 'associate_settings'])->name('associates.settings');  
    Route::get('/colaboraciones', [AssociateController::class, 'collaborations'])->name('associates.collaborations');  
});

/*Ajustes*/
Route::middleware(['auth', 'verified'])->prefix('tablero/')->group(function () {
    Route::get('/ajustes/', [ProfileCollaboratorController::class, 'index'])->name('collaborator.ajustes.index');  
    Route::put('/ajustes/profile', [ProfileCollaboratorController::class, 'profile'])->name('collaborator.profile.update');  
    Route::put('/ajustes/fiscal', [ProfileCollaboratorController::class, 'fiscal'])->name('collaborator.fiscal.update');  
});

/*Admin*/

Route::middleware(['auth', 'verified', 'role:Admin'])->prefix('admin')->group(function () {

    Route::get('/colaboradores', [AdminController::class, 'colaboradores'])->name('admin.colaboradores');
    Route::get('/crear/colaborador', [AdminController::class, 'collaborator_create'])->name('admin.collaborator.create');
    Route::get('/editar/colaborador/{id}', [AdminController::class, 'collaborator_edit'])->name('admin.collaborator.edit');
    Route::put('/actualizar/colaborador/{id}', [AdminController::class, 'collaborator_updt'])->name('admin.collaborator.updt');
    Route::delete('/eliminar/colaborador/{id}', [AdminController::class, 'collaborator_delete'])->name('admin.collaborator.delete');
    Route::post('/colaborador/store', [AdminController::class, 'collaborator_store'])->name('admin.collaborator.store');
    Route::get('/colaborador/{id}', [AdminController::class, 'collaborator_details'])->name('admin.collaborator.show');

    /*Asociados*/
    Route::get('/asociados', [AdminController::class, 'associates'])->name('admin.associates');
    Route::get('/asociados/crear-asociado', [AdminController::class, 'associates_create'])->name('admin.associates.create');
     Route::post('/asociados/store', [AdminController::class, 'associates_store'])->name('admin.associates.store');
    Route::get('/asociados/editar-asociado/{user}', [AdminController::class, 'associates_edit'])->name('admin.associates.edit');
     Route::put('/asociados/updt/{id}', [AdminController::class, 'associates_updt'])->name('admin.associates.updt');
    Route::get('/asociados/detalle/{id}', [AdminController::class, 'associate_details'])->name('admin.associates.show');
    /*Alojamientos*/
    Route::get('/crear/alojamiento/{collaborator}', [AdminController::class, 'lodging_create'])->name('admin.lodging.create');
    Route::post('/store/alojamiento', [AdminController::class, 'lodging_store'])->name('admin.lodging.store');
    Route::get('/editar/alojamiento/{id}/colaborador/{idcol}', [AdminController::class, 'collaborator_lodging_edit'])->name('admin.lodging.edit');
    Route::post('/update/alojamiento/{id}', [AdminController::class, 'collaborator_lodging_update'])->name('admin.lodging.update');
    Route::delete('/eliminar/alojamiento/{hotel}/{collaborator}', [AdminController::class, 'lodging_delete'])->name('admin.lodging.delete');
    Route::get('/alojamiento/{hab}/{id}', [AdminController::class, 'sales_hab_details'])->name('admin.hotel.details');
    Route::get('/alojamientos/ventas/{id}', [AdminController::class, 'sales_hab'])->name('admin.sales.hab');  
    Route::get('/alojamientos/transaccion/{id}/{shipping}', [AdminController::class, 'transaction'])->name('admin.hab.transaction');  
    Route::post('/alojamientos/transaccion/devolucion', [AdminController::class, 'returned_order'])->name('admin.order.returned');  
    Route::post('/alojamientos/envios/devolucion', [AdminController::class, 'returned_shipping'])->name('admin.shipping.returned');  

    /*ADMINISTRADORES*/
    Route::get('/ajustes/administradores', [AdminController::class, 'admins'])->name('admin.administradores');
    Route::get('/crear/administrador', [AdminController::class, 'administrator_create'])->name('admin.administrator.create');
    Route::post('/administrador/store', [AdminController::class, 'administrator_store'])->name('admin.administrator.store');
    Route::get('/administrador/{id}', [AdminController::class, 'administrator_details'])->name('admin.administrator.show');
    Route::get('/souvenirs', [AdminController::class, 'souvenirs'])->name('admin.souvenirs');
    Route::get('/souvenirs/crear', [AdminController::class, 'souvenirs_create'])->name('admin.souvenirs.create');
    Route::get('/souvenirs/editar/{id}/{numPage}', [AdminController::class, 'souvenirs_edit'])->name('admin.souvenirs.edit');

    Route::get('/ventas', [AdminController::class, 'sales'])->name('admin.sales');
    Route::get('/ventas/pedido/{id}', [AdminController::class, 'sales_detail'])->name('admin.sales.transaction');
    Route::get('/activities', [ActivitiesController::class, 'activities'])->name('admin.activities');

    Route::post('/settings/shippings', [AdminController::class, 'shippings_create'])->name('settings.shippings.create');
    Route::post('/settings/shippings/{id}', [AdminController::class, 'shippings_update'])->name('settings.shippings.update');

    
    /*Colaboradores*/
    
});
Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {

Route::resource(
        'admin',
        AdminController::class, [
            'names' => [
                'index'     => 'admin.index',
                'create'    => 'admin.create',
                'store'     => 'admin.store',
                'update'     => 'admin.update',
                'destroy'   => 'admin.destroy',
            ],
            ['except' => ['edit','show']]
        ],
    );
});

/*API*/

Route::get('/update/api', [ActivitiesController::class, 'api'])->name('update.api');
/*Pruebas (las rutas de abajo se debe eliminar es solo para pruebas)*/
Route::get('/test',function(){
    return view('mails.souvenirs');
});

require __DIR__.'/auth.php';
