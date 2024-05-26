<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Music;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::middleware('auth', 'verified')->group(function () {
    // Bands
    Route::Get('/band/edit/{id}', [BandController::class, 'editBandView'])->name('edit_band_view');
    Route::Post('/band/edit', [BandController::class, 'editBand'])->name('edit_band');

    // Musics
    Route::get('/music/edit/{id}', [MusicController::class, 'editMusicView'])->name('edit_music_view');
    Route::post('/music/edit', [MusicController::class, 'editMusic'])->name('edit_music');
    Route::Post('/music/store', [MusicController::class, 'storeMusic'])->name('store_music');
    Route::get('/music/addtofavourites/{idMusic}', [UserController::class, 'addToFavourites'])->name('add_favourites_music');

    // Albums
    Route::get('/album/edit/{album_id}', [AlbumController::class, 'editAlbumView'])->name('edit_album_view');
    Route::post('/album/edit', [AlbumController::class, 'editAlbum'])->name('edit_album');

    // User
    Route::get('/user/profile', [UserController::class, 'indexUser'])->name('user_profile');
    Route::Post('/user/profile/update', [UserController::class, 'updateUser'])->name('update_user_profile');
});

Route::middleware(['auth', 'verified', EnsureUserIsAdmin::class])->group(function () {
    // Albums
    Route::get('/album/create/{band_id}', [AlbumController::class, 'createAlbumView'])->name('create_album');
    Route::Post('/album/create', [AlbumController::class, 'storeAlbum'])->name('store_album');
    Route::get('/album/delete/{album_id}', [AlbumController::class, 'deleteAlbum'])->name('delete_album');

    // Musics
    Route::get('/music/delete/{id}', [MusicController::class, 'deleteMusic'])->name('delete_music');
    Route::get('/create/music/{idBand}/{idAlbum}', [MusicController::class, 'createMusicView'])->name('create_music');

    // Bands
    Route::get('/create/band', [BandController::class, 'createBandView'])->name('create_band');
    Route::post('/store/band', [BandController::class, 'storeBand'])->name('store_band');
    Route::get('/band/delete/{id}', [BandController::class, 'deleteBand'])->name('delete_band');

    // User
    Route::get('/admin/dashboard', [DashboardController::class, 'indexDashboard'])->name('user_dashboard');

});


Route::get('/email/verify', function () {
    return redirect()->route('route_home')->with('verify', 'Verifica o teu email para teres acesso a todas as features!');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('user_profile')->with('verifyEmail', 'Email verificado com sucesso!');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::Get('/band/{id}', [BandController::class, 'viewBand'])->name('index_band');
Route::get('/music/{id}', [MusicController::class, 'indexMusic'])->name('index_music');
Route::Get('/album/{id}', [AlbumController::class, 'indexAlbum'])->name('index_album');

Route::get('/', [IndexController::class, 'getHomeView'])->name('route_home');
Route::get('/home', [IndexController::class, 'getHomeView'])->name('route_home');

Route::post('/register', [UserController::class, 'registerUser'])->name('register_user');


Route::get('/all/{name}', [IndexController::class, 'getAllitems'])->name('index_all');
Route::fallback([IndexController::class, 'getFallBack'])->name('fallback');


