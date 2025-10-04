<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// Главная
Route::get('/', [HomeController::class, 'index'])->name('home');

// Каталог и товары
Route::get('/catalog/{category?}', [ProductController::class,'index'])->name('catalog.index');
Route::get('/product/{slug}', [ProductController::class,'show'])->name('product.show');

// Корзина
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
Route::post('/cart/{id}/update', [CartController::class,'update'])->name('cart.update');
Route::post('/cart/{id}/remove', [CartController::class,'remove'])->name('cart.remove');

// Оформление заказа
Route::get('/checkout', [CheckoutController::class,'showForm'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class,'placeOrder'])->name('checkout.place');

// Страницы
Route::get('/page/{slug}', [PageController::class,'show'])->name('page.show');

// Авторизация (вход/регистрация/сброс пароля/верификация email)
Auth::routes(['verify' => true]);
Route::middleware('auth')->group(function(){
    Route::get('/account', [\App\Http\Controllers\AccountController::class, 'index'])->name('account.index');
    Route::put('/account', [\App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
    Route::put('/account/password', [\App\Http\Controllers\AccountController::class, 'updatePassword'])->name('account.password');
});

// Админка
Route::prefix('admin')->name('admin.')->middleware(['auth','is_admin'])->group(function(){
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->name('dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('brands', AdminBrandController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('pages', AdminPageController::class);
    Route::resource('orders', AdminOrderController::class)->only(['index','show','destroy']);
    Route::post('orders/{order}/status', [AdminOrderController::class,'updateStatus'])->name('orders.updateStatus');
    Route::resource('users', AdminUserController::class);
});


