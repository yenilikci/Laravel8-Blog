<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('giris', [Auth::class, 'login'])->name('login');
    Route::post('giris', [Auth::class, 'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', [Dashboard::class, 'index'])->name('dashboard');
    //article route
    Route::get('makaleler/silinenler',[ArticleController::class,'trashed'])->name('trashed.article');
    Route::resource('makaleler', ArticleController::class);
    Route::get('/switch',[ArticleController::class,'switch'])->name('switch');
    Route::get('/deletearticle/{id}',[ArticleController::class,'delete'])->name('delete.article');
    Route::get('/harddelete/{id}',[ArticleController::class,'harddelete'])->name('hard.delete.article');
    Route::get('/recoverarticle/{id}',[ArticleController::class,'recover'])->name('recover.article');
    //category route
    Route::get('/kategoriler',[CategoryController::class,'index'])->name('category.index');
    Route::post('/kategoriler/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/kategoriler/update',[CategoryController::class,'update'])->name('category.update');
    Route::get('/kategori/switch',[CategoryController::class,'switch'])->name('category.switch');
    Route::get('/kategori/getData',[CategoryController::class,'getData'])->name('category.getdata');


    Route::get('cikis', [Auth::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [Homepage::class, 'index'])->name('homepage');
Route::get('/sayfa', [Homepage::class, 'index']);
Route::get('/iletisim', [Homepage::class, 'contact'])->name('contact');
Route::post('/iletisim', [Homepage::class, 'contactpost'])->name('contact.post');
Route::get('/{sayfa}', [Homepage::class, 'page'])->name('page');
Route::get('/kategori/{category}', [Homepage::class, 'category'])->name('category');
Route::get('/{category}/{slug}', [Homepage::class, 'single'])->name('single');
