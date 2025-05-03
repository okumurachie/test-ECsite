<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/details/{id}', [ItemController::class, 'show']);
    Route::get('/item/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/item/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/item/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/item/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/purchase', [ItemController::class, 'showPurchaseForm'])->name('purchase.form');
    Route::post('/purchase', [ItemController::class, 'processPurchase'])->name('purchase.process');
});



// 管理者用ルート
Route::prefix('admin')->group(function () {
    // ログイン関連
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // 登録関連
    Route::get('register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [AdminController::class, 'register']);

    // 管理者のみアクセス可能なルート
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // 商品関連のルート
        Route::get('item/add', [AdminController::class, 'add'])->name('admin.item.add');
        Route::post('item/add', [AdminController::class, 'store']);
        Route::get('item/list', [AdminController::class, 'showEditList'])->name('admin.item.list');
        Route::get('item/edit/{id}', [AdminController::class, 'edit'])->name('admin.item.edit');
        Route::patch('/items/update/{id}', [AdminController::class, 'update'])->name('items.update');
        Route::patch('/items/imageUpdate/{id}', [AdminController::class, 'imageUpdate'])->name('items.imageUpdate');
        Route::get('/item/delete/{id}', [AdminController::class, 'delete']);
        Route::post('/items/delete/{id}', [AdminController::class, 'softDelete'])->name('items.softDelete');
        Route::get('item/shipping_list', [AdminController::class, 'showShippingList'])->name('admin.item.shipping_list');
        Route::post('/purchase/{id}/ship', [AdminController::class, 'ship'])->name('purchase.ship');
    });
});
