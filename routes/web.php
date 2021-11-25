<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*Controladores*/
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PruebaController;
/*
|--------------------------------------------------------------------------
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

Route::get('/', function () {
    return Inertia::render('Statics/Home');
})->name('home');

Route::get('/quienes-somos', function () {
    return Inertia::render('Statics/AboutUs');
})->name('about.us');

Route::get('/contactanos', function () {
    return Inertia::render('Statics/ContactUs');
})->name('contact');


/*
    Auth
 */

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

/*
    Dashboard
 */
Route::middleware(['auth', 'verified'])->prefix('tablero')->group(function () {
    Route::get('/perfil', function () {
        return Inertia::render('Dashboard/Profile');
    })->name('dashboard');
    Route::get('mis-actividades', function () {
        return Inertia::render('Dashboard/Activities');
    })->name('dashboard.activities');
    Route::get('mis-souvenirs', function () {
        return Inertia::render('Dashboard/Souvenirs');
    })->name('dashboard.souvenirs');
    Route::get('/compras', function () {
        return Inertia::render('Dashboard/Shoppings');
    })->name('dashboard.shopping');

    /*
        HOTELES ADMIN
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
                'update'    => 'hotels.update',
                'destroy'   => 'hotels.destroy',
            ],
        ],
    )->middleware(['role:Admin']);
  
});
Route::resource(
    'perfil',
    ProfileController::class, [
        'names' => [
            'create'    => 'profile.create',
            'edit'      => 'profile.edit',
            'show'      => 'profile.show',
            'store'     => 'profile.store',
            'update'    => 'profile.update',
            'destroy'   => 'profile.destroy',
        ],
        ['except' => ['index']]
    ],
)->middleware(['auth', 'verified']); 


/*
    Shop
 */

Route::get('/tienda/actividades', function () {
    return Inertia::render('Shop/Tours');
})->name('activities');

Route::get('/tienda/souvenirs', function () {
    return Inertia::render('Shop/Souvenirs');
})->name('souvenirs');

Route::get('/producto', function () {
    return Inertia::render('Product');
})->name('producto');
Route::get('/detalles-actividad', function () {
    return Inertia::render('DetailTours');
})->name('detalles-actividad');

/*
    Admin
 */

/*
    Payment
 */
Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->name('checkout');

Route::get('/carrito', function () {
    return Inertia::render('Cart');
})->name('cart');

Route::get('/dashboardb', function () {
    return Inertia::render('DashboardBack');
})->middleware(['auth', 'verified'])->name('dashboardb');


/*********REGISTROS**********************/


/*
ADMINS
 */

Route::resource(
    'admin',
    AdminController::class, [
        'names' => [
            'index'     => 'admin.index',
            'create'    => 'admin.create',
            'edit'      => 'admin.edit',
            'show'      => 'admin.show',
            'store'     => 'admin.store',
            'update'    => 'admin.update',
            'destroy'   => 'admin.destroy',
        ],
    ],
);

/*************RUTAS PARA REALIZAR PRUEBAS ****************************/
Route::get('/prueba', [PruebaController::class, 'index'])->name('prueba.index');







require __DIR__.'/auth.php';
