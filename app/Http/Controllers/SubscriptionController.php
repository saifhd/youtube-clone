<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function is_subscribed($id){
        $count=auth()->user()->subscribed_channels->where('id',$id)->count();
        $subscriptions=Channel::find($id)->subscribed_users->count();
        $data=[
            'count'=>$count,
            'subscriptions'=>$subscriptions
        ];
        return response()->json($data);
    }
    public function store(Request $request)
    {
        auth()->user()->subscribed_channels()->attach([$request->channel_id]);
        return response()->json(['success'=>'Successfully Subscribed']);
    }

    public function destroy($id)
    {
        $channel=Channel::find($id);
        // return response()->json($channel);
        if($channel->subscribed_users()->detach(auth()->user()->id)){
            return response()->json("success");
        }
        return response()->json("Error");

    }
}
