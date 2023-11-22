<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController as HomeCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CommentController as HomeCommentController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ProductController as HomeProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WishlistController;
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
    Route::resource('banners', BannerController::class);
    Route::resource('comments', AdminCommentController::class);
    Route::resource('coupons', CouponController::class);

    // Comment Change Approve
    Route::get('/comment/{comment}/change-approve', [AdminCommentController::class, 'changeApprove'])->name('comments.change_approve');

    // Get category attributes
    Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);

    // Edit product images
    Route::get('/products/{product}/images-edit', [ProductImageController::class, 'edit'])->name('products.images.edit');
    Route::delete('/products/{product}/images-destroy', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::put('/products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.set_primary');
    Route::put('/products/{product}/images-add', [ProductImageController::class, 'add'])->name('products.images.add');

    // Edit product category
    Route::get('/products/{product}/category-edit', [ProductController::class, 'editCategory'])->name('products.category.edit');
    Route::put('/products/{product}/category-update', [ProductController::class, 'updateCategory'])->name('products.category.update');
});

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Category Page
Route::get('/category/{category:slug}', [HomeCategoryController::class, 'show'])->name('home.categories.show');

// Product Single Page
Route::get('/product/{product:slug}', [HomeProductController::class, 'show'])->name('home.products.show');

// Store Comment In Product Single Page
Route::post('/comments/store/{product}', [HomeCommentController::class, 'store'])->name('home.comments.store');

// Wishlist
Route::get('/add-to-wishlist/{product}', [WishlistController::class, 'add'])->name('home.wishlist.add');
Route::get('/remove-from-wishlist/{product}', [WishlistController::class, 'remove'])->name('home.wishlist.remove');

// Compare
Route::get('/compare', [CompareController::class, 'index'])->name('home.compare.index');
Route::get('/add-to-compare/{product}', [CompareController::class, 'add'])->name('home.compare.add');
Route::get('/remove-from-compare/{product}', [CompareController::class, 'remove'])->name('home.compare.remove');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('home.cart.index');
Route::put('/cart', [CartController::class, 'update'])->name('home.cart.update');
Route::post('/add-to-cart', [CartController::class, 'add'])->name('home.cart.add');
Route::get('/clear-cart', [CartController::class, 'clear'])->name('home.cart.clear');
Route::get('/remove-from-cart/{rowId}', [CartController::class, 'remove'])->name('home.cart.remove');

// OTP Auth
Route::prefix('user/')->name('user.')->group(function () {
    Route::any('login', [AuthController::class, 'login'])->name('login');
    Route::post('check-otp', [AuthController::class, 'checkOtp'])->name('check_otp');
    Route::post('resend-otp', [AuthController::class, 'resendOtp'])->name('resend_otp');
});

// User Profile
Route::prefix('profile/')->name('home.')->group(function () {
    Route::get('/', [UserProfileController::class, 'index'])->name('user_profile.index');
    Route::get('/comments', [HomeCommentController::class, 'userProfileCommentsIndex'])->name('user_profile.comments');
    Route::get('/wishlist', [WishlistController::class, 'userProfileWishlistIndex'])->name('user_profile.wishlist');
});

