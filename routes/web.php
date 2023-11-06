<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\TagController;
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

Route::get('/admin-panel/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::prefix('admin-panel/')->name('admin.')->group(function () {
    Route::resource('brands', BrandController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);

    // Get category attributes
    Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);

    // Edit product image
    Route::get('/products/{product}/images-edit', [ProductImageController::class, 'edit'])->name('products.images.edit');

    // Destroy product image
    Route::delete('/products/{product}/images-destroy', [ProductImageController::class, 'destroy'])->name('products.images.destroy');

    // Set primary image
    Route::put('/products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.set_primary');

    // Set primary image
    Route::put('/products/{product}/images-add', [ProductImageController::class, 'add'])->name('products.images.add');
});
