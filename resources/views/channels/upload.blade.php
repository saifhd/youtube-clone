@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <channel-uploads :channel="{{ $channel }}" url="{{ env('APP_URL') }}"></channel-uploads>
    </div>
</div>
@endsection

