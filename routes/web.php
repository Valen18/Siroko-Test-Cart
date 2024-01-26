<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Listado de productos
Route::get('/', [ProductController::class, 'index']);

// Crear un nuevo producto (formulario y acción de guardado)
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);

// Mostrar un producto específico
Route::get('/products/{product}', [ProductController::class, 'show']);

// Editar un producto (formulario y acción de actualización)
Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
Route::put('/products/{product}', [ProductController::class, 'update']);

// Eliminar un producto
Route::delete('/products/{product}', [ProductController::class, 'destroy']);

// Añadir un producto al carrito
Route::post('/cart/add', [CartController::class, 'addToCart']);

// Actualizar un producto en el carrito
Route::patch('/cart/update/{product}', [CartController::class, 'updateCartItem']);

// Eliminar un producto del carrito
Route::delete('/cart/remove/{product_id}', [CartController::class, 'removeFromCart']);

// Mostrar los contenidos del carrito
Route::get('/cart', [CartController::class, 'showCart']);

// Vaciar el carrito
Route::post('/cart/clear', [CartController::class, 'clearCart']);

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/completar-compra', [CartController::class, 'completePurchase']);
