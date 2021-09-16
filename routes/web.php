<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PurchaseController;

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

Route::get('/', [FrontpageController::class, 'index']);
Route::get('/product/{slug}', [ProductsController::class, 'product'])->name('product');
Route::get('/category/{slug}', [ProductsController::class, 'productsByCategory'])->name('products.bycategory');
Route::get('/products/all', [ProductsController::class, 'products'])->name('products.all');
Route::get('/post/{slug}', [PostsController::class, 'post'])->name('post');
Route::get('/message', [MessagesController::class, 'message'])->name('message.index');
Route::post('/message', [MessagesController::class, 'store'])->name('message.store');
Route::get('/contact', [FrontpageController::class, 'contact'])->name('contact');
Route::get('/shipping', [FrontpageController::class, 'shipping'])->name('shipping');
Route::get('/offer', [OffersController::class, 'offer'])->name('offer');
Route::post('/offer', [OffersController::class, 'store'])->name('offer.store');
Route::get('/filter/products', [ProductsController::class, 'filter']);
Route::get('/about-us', [FrontpageController::class, 'aboutus'])->name('aboutus');
Route::get('/terms', [FrontpageController::class, 'terms'])->name('terms');
Route::get('/cookie', [FrontpageController::class, 'cookie'])->name('cookie');
Route::get('/policy', [FrontpageController::class, 'policy'])->name('policy');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'cart'])->name('cart');
    Route::get('session', [CartController::class, 'session']);
    Route::post('add', [CartController::class, 'addItem']);
    Route::post('remove', [CartController::class, 'removeItem']);
    Route::post('decrement', [CartController::class, 'decrementItem']);
    Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');
});

/**
 * AUTH - only as admin
 */
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::prefix('admin')->group(function () {
        
        // Route::get('/', [AdminPageController::class, 'index'])->name('admin');
        Route::get('/contact', [AdminPageController::class, 'contact'])->name('admin.contact');
        Route::post('/contact', [SettingsController::class, 'updateContact'])->name('admin.contact.update');
        
        Route::post('/shipping', [SettingsController::class, 'updateShipping'])->name('admin.shipping.update');
        Route::get('/shipping', [AdminPageController::class, 'shipping'])->name('admin.shipping');
        
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    
        Route::get('messages', [MessagesController::class, 'index'])->name('messages');
        Route::get('messages/{id}', [MessagesController::class, 'show'])->name('messages.show');
        Route::get('messages/setunread/{id}', [MessagesController::class, 'setTotRead'])->name('messages.setreaded');
        Route::get('messages/archive/{id}', [MessagesController::class, 'archiveMessage'])->name('messages.setarchive');
        
        Route::get('media', [MediaController::class, 'index'])->name('media');
        Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
        Route::post('media/upload-editor', [MediaController::class, 'uploadWithEditor']);
        Route::get('media/image/{id}', [MediaController::class, 'editImage'])->name('media.image');
        Route::post('media/image/delete', [MediaController::class, 'delete'])->name('media.image.delete');
        Route::get('/media/images', [MediaController::class, 'getImages']);
    
        Route::resource('categories', CategoriesController::class);
     
        Route::resource('products', ProductsController::class);

        Route::resource('posts', PostsController::class);

        Route::get('slideshow', [SettingsController::class, 'settingsSlideshow'])->name('settings.slideshow');
        Route::post('slideshow', [SettingsController::class, 'settingsSaveSlideshow'])->name('settings.slideshow.save');
        
        Route::get('offer', [OffersController::class, 'offerContent'])->name('admin.offer.content');
        Route::post('offer', [OffersController::class, 'updateOfferContent'])->name('admin.offer.update');
        Route::get('offer/{id}', [OffersController::class, 'show'])->name('admin.offer');
        Route::get('/', [OffersController::class, 'index'])->name('admin.offers');

        Route::get('aboutus', [AdminPageController::class, 'aboutus'])->name('admin.aboutus');
        Route::put('aboutus', [SettingsController::class, 'updateAboutUsContent'])->name('admin.aboutus.update');
        
        Route::get('terms', [AdminPageController::class, 'terms'])->name('admin.terms');
        Route::put('terms', [SettingsController::class, 'updateTermsContent'])->name('admin.terms.update');
        
        Route::get('policy', [AdminPageController::class, 'policy'])->name('admin.policy');
        Route::put('policy', [SettingsController::class, 'updatePolicyContent'])->name('admin.policy.update');
        
        Route::get('cookie', [AdminPageController::class, 'cookie'])->name('admin.cookie');
        Route::put('cookie', [SettingsController::class, 'updateCookieContent'])->name('admin.cookie.update');
        
        Route::get('orders', [OrdersController::class, 'orders'])->name('admin.orders');
        Route::get('orders/{id}', [OrdersController::class, 'order'])->name('admin.order');
    });
    
});

/**
 * AUTH - normal users
 */
Route::group(['middleware' => ['auth']], function () {

    Route::prefix('user')->group(function () {
        Route::get('profile', [ProfileController::class, 'showUserProfile'])->name('user.profile');
        Route::post('profile', [ProfileController::class, 'updateUserProfile'])->name('user.profile.update');
        Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        
        Route::get('addresses', [ProfileController::class, 'showUserAddresses'])->name('user.profile.addresses');
        Route::post('addresses', [ProfileController::class, 'storeNewAddress'])->name('user.profile.addresses.store');
        Route::put('addresses', [ProfileController::class, 'updateAddress'])->name('user.profile.addresses.update');
        
        Route::get('orders', [ProfileController::class, 'showUserOrders'])->name('user.profile.orders');
        Route::get('orders/{id}', [ProfileController::class, 'showUserOrder'])->name('user.profile.order');

    });
    
    Route::post('checkout', [PurchaseController::class, 'checkout'])->name('checkout');
    Route::post('purchase', [PurchaseController::class, 'purchase'])->name('purchase');
    Route::get('orders/{hash}', [PurchaseController::class, 'showOrder'])->name('purchase.order');

});



require __DIR__.'/auth.php';