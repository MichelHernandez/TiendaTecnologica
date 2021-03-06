<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CompraController;

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

Route::get('/', [ProductController::class, 'welcome'])->name('inicio');

Route::get('/admin-dashboard', [DashboardController::class, 'superIndex'])->middleware(['auth'])->name('admindashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/productos', [ProductController::class, 'index'])->name('productos-index');
Route::get('/productos/{id}/detalles', [ProductController::class, 'show'])->middleware(['auth'])->name('productos-show');

Route::get('/productos/crear', [ProductController::class, 'create'])->middleware(['auth'])->name('productos-create');
Route::post('/productos/crear', [ProductController::class, 'store'])->middleware(['auth'])->name('productos-store');

Route::get('/productos/{id}/editar', [ProductController::class, 'edit'])->middleware(['auth'])->name('productos-edit');
Route::put('/productos/{id}/editar', [ProductController::class, 'update'])->middleware(['auth'])->name('productos-update');

Route::get('/productos/{id}/eliminar', function($id){
    return view('productos.delete', ['id' => $id]);
})->middleware(['auth'])->name('productos-delete');
Route::delete('/productos/{id}/eliminar', [ProductController::class, 'destroy'])->middleware(['auth'])->name('productos-destroy');

Route::post('/cart-add',[CartController::class, 'add'])->name('cart.add');

Route::get('/checkout',[CartController::class, 'cart'])->name('cart.checkout');

Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');

Route::post('/cart-clear',[CartController::class, 'clear'])->name('cart.clear');

Route::post('/cart-remove',[CartController::class, 'remove'])->name('cart.remove');

Route::get('/compras', [CompraController::class, 'index'])->name('compras');


//Paypal
Route::get('/paypal/pago/{monto}', [PaymentController::class, 'payWithPaypal'])->name('pago');
Route::get('/paypal/status', [PaymentController::class, 'payPalStatus'])->name('pago-estado');

require __DIR__.'/auth.php';
