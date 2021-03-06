<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SwipeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\EventController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('users.showProfile');
    Route::post('/postProfile', [UserController::class, 'storeProfile'])->name('users.storeProfile');
    Route::get('/editProfile', [UserController::class, 'showEditProfile'])->name('users.editProfile');
    Route::post('/editProfile', [UserController::class, 'updateEditProfile'])->name('users.updateProfile');
    Route::get('/notice', [UserController::class, 'notice'])->name('users.notice');
    Route::get('/notice/detail/{id}', [UserController::class, 'detailNotice'])->name('users.noticeDetail');
    Route::get('/notice/yes/{id}', [UserController::class, 'yesEvent'])->name('yesEvent');
    Route::get('/notice/no/{id}', [UserController::class, 'noEvent'])->name('noEvent');

    Route::post('/swipes', [SwipeController::class, 'store'])->name('swipes.store');

    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
    Route::get('/matchuser/{id}', [MatchController::class, 'showMatchuser'])->name('matches.user');
    Route::get('/chat/{id}', [MatchController::class, 'showChat'])->name('matches.chat');
    Route::post('/chat', [MatchController::class, 'sendChat'])->name('chat');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/hold', [EventController::class, 'showHold'])->name('events.hold');
    Route::post('/events/post', [EventController::class, 'post'])->name('events.post');
    Route::get('/events/delete/{id}', [EventController::class, 'delete'])->name('events.delete');
    Route::get('/events/list', [EventController::class, 'list'])->name('events.list');
    Route::get('/events/detail/{id}', [EventController::class, 'showDetail'])->name('events.detail');
    Route::get('/events/reserved', [EventController::class, 'reserved'])->name('events.reserved');
    Route::get('/events/withdraw/{id}', [EventController::class, 'withdraw'])->name('events.withdraw');
    Route::get('/events/decline/{id}', [EventController::class, 'decline'])->name('events.decline');
    Route::get('/events/apply/{id}', [EventController::class, 'apply'])->name('events.apply');
    Route::get('/events/liked', [EventController::class, 'liked'])->name('events.liked');
    Route::post('/events/like', [EventController::class, 'like'])->name('events.like');
    Route::get('/events/held', [EventController::class, 'showHeld'])->name('events.held');
    Route::get('/events/search', [EventController::class, 'showSearch'])->name('events.showSearch');
    Route::post('/events/search', [EventController::class, 'search'])->name('events.search');

    Route::get('/test', [EventController::class, 'batch'])->name('test.batch');



});
