<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;
use App\Models\Music;
use Illuminate\Support\Facades\Route;




// Bands
Route::get('/band/create', [BandController::class, 'createBandView'])->name('create_band');
Route::post('/band/create', [BandController::class, 'storeBand'])->name('store_band');
Route::Get('/band/{id}', [BandController::class, 'viewBand'])->name('index_band');

// Musics
Route::get('/music/create', [MusicController::class, 'createMusicView'])->name('create_music');
Route::Post('/music/create', [MusicController::class, 'storeMusic'])->name('store_music');
Route::get('/music/{id}', [MusicController::class, 'indexMusic'])->name('index_music');

// Albums
Route::get('/album/create/{band_id}', [AlbumController::class, 'createAlbumView'])->name('create_album');
Route::Post('/album/create', [AlbumController::class, 'storeAlbum'])->name('store_album');
Route::Get('/album/{id}', [AlbumController::class, 'indexAlbum'])->name('index_album');


Route::get('/', [IndexController::class, 'getHomeView'])->name('route_home');
Route::get('/user/profile', [IndexController::class, function () {
    return view('user.profile');
}])->name('user_profile');
Route::post('/register/create/user', [UserController::class, 'registerUser'])->name('register_user');
Route::get('/user/admin/dashboard', [IndexController::class, function () {
    return view('user.dashboard_admin');
}])->name('user_admin_dashboard');


Route::get('/all/{id}', [IndexController::class, 'getPage'])->name('route_Page');
Route::fallback([IndexController::class, 'getFallBack']);


