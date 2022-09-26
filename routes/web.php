<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// route utama
Route::get('/', function () {
    return view('main');
});
// Route::get('/', [App\Http\Controllers\DasboardController::class, 'index'])->name('dashboard');
Route::post('/search', 'App\Http\Controllers\DasboardController@search')->name('cari');

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    //data testing
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/testadd', [App\Http\Controllers\TestingController::class, 'add'])->name('test.add');
    Route::post('/testnew', [App\Http\Controllers\TestingController::class, 'new'])->name('test.new');
    Route::get('/testedit//{id}', [App\Http\Controllers\TestingController::class, 'edit'])->name('test.edit');
    Route::put('/testupdate/{id}', [App\Http\Controllers\TestingController::class, 'update'])->name('test.update');
    Route::get('/testdelete/{id}', [App\Http\Controllers\TestingController::class, 'delete'])->name('test.delete');
    Route::get('/testkosong', [App\Http\Controllers\TestingController::class, 'kosong'])->name('test.kosong');
    // Route::get('/testdata', [App\Http\Controllers\TestingController::class, 'data'])->name('test.data');
    Route::post('/testimport', [App\Http\Controllers\TestingController::class, 'import'])->name('test.import');
    Route::post('/testnorm', [App\Http\Controllers\TestingController::class, 'normalize'])->name('test.norm');
    Route::get('/norm.test', [App\Http\Controllers\TestingController::class, 'norm'])->name('normalisasi');

    //data uji
    Route::get('/uji', [App\Http\Controllers\UjiController::class, 'index'])->name('uji.read');
    Route::get('/ujiadd', [App\Http\Controllers\UjiController::class, 'add'])->name('uji.add');
    Route::post('/ujinew', [App\Http\Controllers\UjiController::class, 'new'])->name('uji.new');
    Route::get('/ujidelete/{id}', [App\Http\Controllers\UjiController::class, 'delete'])->name('uji.delete');
    Route::get('/ujikosong', [App\Http\Controllers\UjiController::class, 'kosong'])->name('uji.kosong');
    // Route::get('/ujidata', [App\Http\Controllers\UjiController::class, 'data'])->name('uji.data');
    Route::post('/ujiimport', [App\Http\Controllers\UjiController::class, 'import'])->name('uji.import');
    Route::post('/ujinorm', [App\Http\Controllers\UjiController::class, 'normalize'])->name('uji.norm');
    Route::get('/norm.uji', [App\Http\Controllers\UjiController::class, 'norm'])->name('norm');

    Route::get('/uji.get', [App\Http\Controllers\UjiController::class, 'get_arr'])->name('uji.get');

    //admin
    Route::get('/profil/{id}', [App\Http\Controllers\DasboardController::class, 'profil'])->name('profil');
    Route::put('/profilupdate/{id}', [App\Http\Controllers\DasboardController::class, 'update'])->name('profil.update');
    Route::post('/changepass', [App\Http\Controllers\DasboardController::class, 'changePass'])->name('change');
});
