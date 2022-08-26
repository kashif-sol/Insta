<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\newsFeed;
use App\Http\Controllers\InstaFeedController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getdata', [newsFeed::class,"instaFeeds"]);
Route::get('/getinsta', [newsFeed::class,"Test"]);
Route::get('insta-feed-show',[InstaFeedController::class,'view_feeds']);

