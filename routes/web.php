<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\StatsController;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::group((['prefix' => '/login', 'as' => 'admin.', 'middleware' => 'admin.guest']), function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::group(['prefix' => '/', 'as' => 'admin.', 'middleware' => 'admin.auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => '/banner', 'as' => 'banner.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [BannerController::class, 'index'])->name('index');
    Route::post('/store', [BannerController::class, 'store'])->name('store');
});

Route::group(['prefix' => '/stats', 'as' => 'stats.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [StatsController::class, 'index'])->name('index');
    Route::post('/store', [StatsController::class, 'store'])->name('store');
});

Route::group(['prefix' => '/service', 'as' => 'service.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::post('/store', [ServiceController::class, 'store'])->name('store');
    Route::post('/data-table', [ServiceController::class, 'dataTable'])->name('datatable');
    Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('edit');
    Route::put('/update', [ServiceController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ServiceController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => '/feature', 'as' => 'feature.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [FeatureController::class, 'index'])->name('index');
    Route::post('/store', [FeatureController::class, 'store'])->name('store');
});

Route::group(['prefix' => '/product', 'as' => 'product.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::post('/data-table', [ProductController::class, 'dataTable'])->name('datatable');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update', [ProductController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => '/faq', 'as' => 'faq.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [FaqController::class, 'index'])->name('index');
    Route::post('/store', [FaqController::class, 'store'])->name('store');
    Route::post('/data-table', [FaqController::class, 'dataTable'])->name('datatable');
    Route::get('/edit/{id}', [FaqController::class, 'edit'])->name('edit');
    Route::put('/update', [FaqController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [FaqController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => '/quote', 'as' => 'quote.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [QuoteController::class, 'index'])->name('index');
    Route::post('/data-table', [QuoteController::class, 'dataTable'])->name('datatable');
    Route::get('/edit/{id}', [QuoteController::class, 'edit'])->name('edit');
    Route::put('/update', [QuoteController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [QuoteController::class, 'delete'])->name('delete');
});


Route::group(['prefix' => '/contact', 'as' => 'contact.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/store', [ContactController::class, 'store'])->name('store');
});

Route::group(['prefix' => '/profile', 'as' => 'profile.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/store', [ProfileController::class, 'store'])->name('store');
});

Route::group(['prefix' => '/site', 'as' => 'site.', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [SiteSettingController::class, 'index'])->name('index');
    Route::post('/store', [SiteSettingController::class, 'store'])->name('store');
});

//Front-End
Route::group(['prefix' => '/', 'as' => 'home.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/form', [HomeController::class, 'form'])->name('form');
    Route::post('/form-quote', [HomeController::class, 'quote'])->name('quote');
});



