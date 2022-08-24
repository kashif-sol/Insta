<?php

use App\Http\Controllers\CustomHighlightController;
use App\Http\Controllers\InstaFeedController;
use App\Http\Controllers\InstaHighlightController;
use App\Http\Controllers\InstaReelController;
use App\Http\Controllers\InstaStoryController;
use App\Http\Controllers\newsFeed;
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
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/insta-feed', function () {
    return view('insta-feed');
});
Route::get('/insta-stories', function () {
    return view('insta-stories');
});
Route::get('/insta-highlights', function () {
    return view('insta-highlights');
});
Route::get('/custom-highlights', function () {
    return view('custom-highlights');
});
Route::get('/insta-reels', function () {
    return view('insta-reels');
});
// Route::get('user',[])
Route::get('/getdata', [newsFeed::class,"instaFeeds"]);
Route::get('/getinsta', [newsFeed::class,"Test"]);

Route::post('store-form',[InstaFeedController::class,'index']);
Route::post('feed/{id}',[InstaFeedController::class,'update'])->name('store.update');
Route::post('insta-story',[InstaStoryController::class,'index']);
Route::post('insta-story/{id}',[InstaStoryController::class,'update'])->name('story.update');
Route::post('insta-highlight',[InstaHighlightController::class,'index']);
Route::post('insta-highlight/{id}',[InstaHighlightController::class,'update'])->name('highlight.update');
Route::post('insta-reel',[InstaReelController::class,'index']);
Route::post('insta-reel/{id}',[InstaReelController::class,'update'])->name('reel.update');
Route::post('custom',[CustomHighlightController::class,'index']);
Route::post('custom/{id}',[CustomHighlightController::class,'update'])->name('custom.update');
Route::post('/save-story',[CustomHighlightController::class,"create"])->name("save-story");
