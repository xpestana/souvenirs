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
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
Route::get('/', [UtilitiesController::class, 'home'])->name('home');
Route::get('/tienda/actividades', [UtilitiesController::class, 'activities'])->name('activities');
Route::get('/tienda/souvenirs', [UtilitiesController::class, 'souvenirs'])->name('souvenirs');
Route::get('/quienes-somos', [UtilitiesController::class, 'about'])->name('about.us');
Route::get('/contactanos', [UtilitiesController::class, 'contact'])->name('contact');
Route::post('/contactanos/send', [UtilitiesController::class, 'contact_mail'])->name('contact.send');
Route::get('/souvenir/{product}/show', [ProductsController::class, 'souvenirs'])->name('product.souvenir.show');
Route::get('/activities/{product}/show', [ProductsController::class, 'activities'])->name('product.activities.show');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.destroy');

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

    Route::get('/store/checkout', [SalesController::class, 'checkout'])->name('checkout.souvenirs');
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
    Route::resource(
        '/admin',
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
    Route::post('/update/activities/{activities}', [ActivitiesController::class, 'update'])->name('update.activities');
    Route::post('/activities/image', [ActivitiesController::class, 'image'])->name('activities.image');
    Route::post('/activities/update/image', [ActivitiesController::class, 'updt_image'])->name('activities.update.image');
    Route::resource(
        '/actividades',
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
});

Route::get('/shoppings/show/{order}', [SalesController::class, 'purchase_show'])->name('purchase.show');
/*
    Dashboard Común
*/
Route::middleware(['auth', 'verified', 'role:Admin|Hotel'])->prefix('tablero')->group(function () {
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

require __DIR__.'/auth.php';
