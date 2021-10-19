<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*Controladores*/
use App\Http\Controllers\HotelController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => false,
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*********REGISTROS**********************/

/*
HOTELES
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
);





/*************RUTAS PARA REALIZAR PRUEBAS ****************************/
Route::get('/prueba', [PruebaController::class, 'index'])->name('prueba.index');
Route::get('/register/hotel', [PruebaController::class, 'hotel'])->name('register.hotel');

require __DIR__.'/auth.php';
