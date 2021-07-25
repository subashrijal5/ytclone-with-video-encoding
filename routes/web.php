<?php

use App\Http\Controllers\ChannelController;
use App\Http\Livewire\Video\Create;
use App\Http\Livewire\Video\Edit;
use App\Http\Livewire\Video\Index;
use App\Http\Livewire\Video\Show;
use App\Http\Livewire\WatchVideo;
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('channel/{channel}/edit', [ChannelController::class, 'edit'])->name('channel.edit');

    Route::group(['prefix' => 'video'], function () {
        Route::get('{channel}/create', Create::class)->name('video.create');
        Route::get('/{channel}', Index::class)->name('video.all');
        Route::get('{channel}/{video}/edit', Edit::class)->name('video.edit');
        Route::get('{channel}/{video}', Show::class)->name('video.show');
    });
});

Route::get('/watch/{video}', WatchVideo::class)->name('video.watch');
