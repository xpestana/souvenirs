<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*Controladores*/
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Products\SouvenirsController;
use App\Http\Controllers\Products\ActivitiesController;
use App\Http\Controllers\Products\CategoriesController;

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
    Route::resource(
        'admin',
        AdminController::class, [
            'names' => [
                'index'     => 'admin.index',
                'create'    => 'admin.create',
                'store'     => 'admin.store',
                'destroy'   => 'admin.destroy',
            ],
            ['except' => ['edit','show','update']]
        ],
    );

    /*
        Souvenirs
     */
    Route::post('/update/souvenirs', [SouvenirsController::class, 'update'])->name('update.souvenirs');
    Route::post('/souvenirs/image', [SouvenirsController::class, 'image'])->name('souvenirs.image');
    Route::post('/souvenirs/update/image', [SouvenirsController::class, 'updt_image'])->name('souvenirs.update.image');

    Route::resource(
        'souvenirs',
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
    Route::resource(
        'actividades',
        ActivitiesController::class, [
            'names' => [
                'index'     => 'activities.index',
                'edit'      => 'activities.edit',
                'create'    => 'activities.create',
                'show'      => 'activities.show',
                'store'     => 'activities.store',
                'update'    => 'activities.update',
                'destroy'   => 'activities.destroy',
            ],
        ],
    );

    /*
        Categorias
     */
    Route::resource(
        'categorias',
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
});


/*
    Dashboard Común
*/
Route::middleware(['auth', 'verified'])->prefix('tablero')->group(function () {
    /*
        Profile
     */
    Route::resource(
        'perfil',
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
    
});





































    Route::get('/compras', function () {
        return Inertia::render('Dashboard/Shoppings');
    })->name('dashboard.shopping');

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

require __DIR__.'/auth.php';
