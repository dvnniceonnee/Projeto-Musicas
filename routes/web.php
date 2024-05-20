<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;
use App\Models\Music;
use Illuminate\Support\Facades\Route;


// Bands
Route::get('/band/create', [BandController::class, 'createBandView'])->name('create_band');
Route::post('/band/create', [BandController::class, 'storeBand'])->name('store_band');
Route::Get('/band/edit/{id}', [BandController::class, 'editBandView'])->name('edit_band_view');
Route::Post('/band/edit', [BandController::class, 'editBand'])->name('edit_band');
Route::get('/band/delete/{id}', [BandController::class, 'deleteBand'])->name('delete_band');
Route::Get('/band/{id}', [BandController::class, 'viewBand'])->name('index_band');

// Musics
Route::get('/music/create', [MusicController::class, 'createMusicView'])->name('create_music');
Route::Post('/music/store', [MusicController::class, 'storeMusic'])->name('store_music');
Route::get('/music/edit/{id}', [MusicController::class, 'editMusicView'])->name('edit_music_view');
Route::post('/music/edit', [MusicController::class, 'editMusic'])->name('edit_music');
Route::get('/music/delete/{id}', [MusicController::class, 'deleteMusic'])->name('delete_music');
Route::get('/music/{id}', [MusicController::class, 'indexMusic'])->name('index_music');


// Albums
Route::get('/album/create/{band_id}', [AlbumController::class, 'createAlbumView'])->name('create_album');
Route::Post('/album/create', [AlbumController::class, 'storeAlbum'])->name('store_album');
Route::get('/album/edit/{album_id}', [AlbumController::class, 'editAlbumView'])->name('edit_album_view');
Route::post('/album/edit', [AlbumController::class, 'editAlbum'])->name('edit_album');
Route::Get('/album/delete/{id}', [AlbumController::class, 'deleteAlbum'])->name('delete_album');
Route::Get('/album/{id}', [AlbumController::class, 'indexAlbum'])->name('index_album');


Route::get('/', [IndexController::class, 'getHomeView'])->name('route_home');
Route::get('/home', [IndexController::class, 'getHomeView'])->name('route_home');


// User
Route::get('/user/profile', [UserController::class,'indexUser' ])->name('user_profile');
Route::post('/register', [UserController::class, 'registerUser'])->name('register_user');
Route::get('/dashboard', [DashboardController::class, 'indexDashboard'])->name('user_dashboard');


Route::get('/all/{id}', [IndexController::class, 'getPage'])->name('route_Page');
Route::fallback([IndexController::class, 'getFallBack'])->name('fallback');


