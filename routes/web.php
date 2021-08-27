<?php

use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UploadVideoController;
use App\Models\Channel;
use App\Models\Subscription;
use App\Models\User;
// use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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

//ChannelsController
Route::resource('/channel',ChannelsController::class);

//SubscriptionsController
Route::resource('/subscriptions', SubscriptionController::class);
Route::get('/subscriptions/{id}/is-subscribed',[SubscriptionController::class, 'is_subscribed']);

//Upload Video Controller
Route::get('channels/{channel}/upload',[UploadVideoController::class,'index'])->name('channel.upload');
Route::post('channels/{channel}/upload', [UploadVideoController::class, 'store']);
Route::get('videos/{video}',[UploadVideoController::class,'show']);

Route::get('up', function () {
    return view('test.upload');
});
Route::post('upload', function (Request $request) {
    $file=$request->file('file');
    $path=$file->store('test','public');
    // dd($path);
    // $path= 'test/ZY1xs0uetVTSzxxutcf9tnJ5fCH44QYiKhVUzJ4m.mp4';

    // dd($d);
    $lowBitrate = (new X264('aac'))->setKiloBitrate(100);
    $midBitrate = (new X264('aac'))->setKiloBitrate(250);
    $highBitrate = (new X264('aac'))->setKiloBitrate(500);
    $f=FFMpeg::fromDisk('public')
    ->open($path)
        ->exportForHLS()
        ->addFormat($lowBitrate)
        ->toDisk('public')
    ->save('videos/asd.m3u8');
        ;
    dd($f);
        //
        // ->addFormat($lowBitrate)
        // ->toDisk('public')
        // ->save('videos/asd.m3u8');
})->name('upload');
