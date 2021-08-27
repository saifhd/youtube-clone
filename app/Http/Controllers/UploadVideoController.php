<?php

namespace App\Http\Controllers;

use App\Jobs\videos\ConvertForStreaming;
use App\Jobs\videos\CreateVideoThumbnail;
use App\Models\Channel;
use App\Models\Video;
// use FFMpeg\FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Bus;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

// use FFMpeg;

class UploadVideoController extends Controller
{
    public function index(Channel $channel){

        // dd($channel);
        return view('channels.upload',compact('channel'));
    }
    public function store(Request $request,Channel $channel){
        // return response()->json($request->title);

        $path= request()->file('video')->store('test', 'public');
        $video=$channel->videos()->create([
            'title'=>$request->title,
            'path'=>$path
        ]);

        CreateVideoThumbnail::dispatch($video);
        ConvertForStreaming::dispatch($video);
        return $video;
    }
    public function show(Video $video){
        if(request()->wantsJson()){
            return response()->json($video);
        }
        return view('videos.video',compact('video'));
    }

}
