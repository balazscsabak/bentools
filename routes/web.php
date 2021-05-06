<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PostsController;

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

Route::group(['middleware' => 'auth'], function () {
    
    Route::prefix('admin')->group(function () {
        
        Route::get('/', [AdminPageController::class, 'index'])->name('admin');
        
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
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
    });
    

});

require __DIR__.'/auth.php';