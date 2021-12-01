<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

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
    return view('welcome');
});

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


require __DIR__.'/auth.php';
