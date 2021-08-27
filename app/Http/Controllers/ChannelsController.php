<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChannelUpdateRequest;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth')->only('update');
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Channel $channel)
    {
        return view('channels.show',compact('channel'));
    }

    public function edit($id)
    {
        //
    }

    public function update(ChannelUpdateRequest $request, Channel $channel)
    {
        $this->authorize('update', $channel);
        if($request->hasFile('image')){
            $channel->clearMediaCollection('images');
            $channel->addMediaFromRequest('image')
            ->toMediaCollection('images');
        }
        $channel->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
