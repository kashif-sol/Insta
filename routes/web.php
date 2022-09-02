<?php
header("Access-Control-Allow-Origin: *");
use App\Http\Controllers\CustomHighlightController;
use App\Http\Controllers\InstaFeedController;
use App\Http\Controllers\InstaHighlightController;
use App\Http\Controllers\InstaReelController;
use App\Http\Controllers\InstaStoryController;
use App\Http\Controllers\newsFeed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestController;

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
Route::group(['middleware' => 'verify.shopify'], function () {
    Route::get('/', function () {
    return view('welcome');
})->name('home');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
Route::get('/insta-feed', function () {
    return view('insta-feed');
});
Route::get('/insta-stories', function () {
    return view('insta-stories');
});
// Route::get('/insta-highlights', function () {
//     return view('insta-highlights');
// });
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
Route::post('chighlight-update/{id}',[CustomHighlightController::class,'update'])->name('customhighlight.update');
Route::post('custom/{id}',[CustomHighlightController::class,'update'])->name('custom.update');
Route::post('/save-story',[CustomHighlightController::class,"create"])->name("save-story");
Route::get('custom-highlights-show',[CustomHighlightController::class,'view_stories'])->name("custom-highlights-show");
Route::get('insta-feed-show',[InstaFeedController::class,'view_feeds'])->name("insta-feed-show");
Route::get('insta-story-show',[InstaStoryController::class,'view_story']);
Route::get('insta-reel-show',[InstaReelController::class,'view_reel'])->name("insta-reel-show");
Route::get('insta-highlight-show',[InstaHighlightController::class,'view_highlight'])->name("insta-highlight-show");
Route::get('dashboard',[newsFeed::class,'dashboard'])->name("dashboard");
Route::get('/faq' , function(){
    return view('faq');
});
// Route::get('/test' , function(){
//     return view('test');
// });
Route::get('test',[TestController::class,'view_feeds']);
Route::get('/installation-guide' , function(){
    return view('installation-guide');
});
Route::get('/settings',[SettingsController::class,"index"])->name("settings");
Route::any('/save-settings',[SettingsController::class,"create"])->name("save-settings");
Route::any('/delete-insta',[newsFeed::class,"delete_insta"]);
});

Route::any('/shop-stories',[CustomHighlightController::class,"shop_stories"]);
Route::get('/delete-image/{id}',[CustomHighlightController::class,"delete_image"]);
