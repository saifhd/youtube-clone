@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{auth()->user()->channel->name }}
                    <a href="{{ route('channel.upload',auth()->user()->channel->id) }}" class="btn btn-sm btn-info" style="float: right;">Upload Video</a>
                </div>
                    @if($errors->any())
                        <ul class="list-group m-4 alert-danger">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item">{{ $error }}</li>
                            @endforeach
                        </ul>

                    @endif
                <div class="card-body">
                    @can('update',$channel)
                        <form id="form" action="{{ route('channel.update',$channel->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row justify-content-center">
                                <div class="channel-avatar">
                                    <img src="{{ $channel->image() }}" alt="" style="width:100%;height:100%;position:absolute;width:100px;height:100px;">

                                        <div class="channel-avatar-overlay"
                                            onclick="document.getElementById('image').click()">
                                                <i class="fas fa-camera fa-4x m-auto"></i>
                                        </div>
                                </div>

                            </div>
                            <input type="file" class="" name="image" id="image" style="display:none;"
                            onchange="document.getElementById('form').submit()">
                            <div class="form-group">
                                <div class="form-control-label">Channel Name</div>
                                <input type="text" name="name" class="form-control" value="{{ $channel->name }}">
                            </div>
                            <div class="form-group">
                                <div class="form-control-label">Description</div>
                                <textarea name="description" cols="30" rows="5" class="form-control">{{ $channel->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Channel</button>
                            </div>

                        </form>
                    @endcan
                    @cannot('update',$channel)
                        <div class="form-group row justify-content-center">
                            <div class="channel-avatar">
                                <img src="{{ $channel->image() }}" alt="" style="width:100%;height:100%;position:absolute;width:100px;height:100px;">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <h4>{{ $channel->name }}</h4>
                            <p>{{ $channel->description }}</p>
                            {{-- <div class="" id="app"> --}}
                                {{-- @dd($channel->id) --}}
                                <subscribe :channel="{{ $channel }}"></subscribe>
                            {{-- </div> --}}
                        </div>

                    @endcannot
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

