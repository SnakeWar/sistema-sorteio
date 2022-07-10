<?php

use App\Http\Controllers\Pages\PagesController;
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
Route::get('/', [App\Http\Controllers\Pages\PagesController::class, 'index'])->name('home');
Route::get('/fale-conosco', [App\Http\Controllers\Pages\PagesController::class, 'fale_conosco'])->name('fale_conosco');
Route::post('/enviar-fale-conosco', [App\Http\Controllers\Pages\PagesController::class, 'enviar_fale_conosco'])->name('enviar_fale_conosco');

Auth::routes();

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);

    Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->middleware('can:read_contacts');

    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->middleware('can:read_roles');

    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('can:read_users');

    Route::get('user/edit', [App\Http\Controllers\Admin\UserController::class, 'edit_user'])->name('edit_user');
    Route::post('user/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update_user'])->name('update_user');

    Route::resource('modules', App\Http\Controllers\Admin\ModuleController::class)->middleware('can:read_modules');

    Route::resource('games', App\Http\Controllers\Admin\GameController::class)->middleware('can:read_games');
    Route::post('games/ativo/{id}', [App\Http\Controllers\Admin\GameController::class, 'ativo'])->name('games.ativo')->middleware('can:update_games');
    Route::post('games/destaque/{id}', [App\Http\Controllers\Admin\GameController::class, 'destaque'])->name('games.destaque')->middleware('can:update_games');

});

Route::middleware('auth')->group(function () {
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');

    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');
});
Route::middleware('auth')->prefix('api')->group(function () {
    Route::resource('/games', \App\Http\Controllers\Api\GameController::class);
    Route::post('/games/store', [\App\Http\Controllers\Api\GameController::class, 'store']);
    Route::get('/games/{id}', [\App\Http\Controllers\Api\GameController::class, 'show']);

    Route::resource('/configurations', \App\Http\Controllers\Api\ConfigurationController::class);
    Route::post('/configurations/store', [\App\Http\Controllers\Api\ConfigurationController::class, 'store']);
    Route::get('/configurations/{id}', [\App\Http\Controllers\Api\ConfigurationController::class, 'show']);
});
Route::resource('/configurations', \App\Http\Controllers\Api\ConfigurationController::class);

