{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$video->title}}</div>

                <div class="card-body">
                    <video id="video_1" class="video-js vjs-default-skin" controls preload="auto" width="640" height="268" data-setup='{}'>
                        <source src="{{ asset('/storage/videos/b34081a9-432f-4d9a-80be-63356d1048d2/b34081a9-432f-4d9a-80be-63356d1048d2_0_100.m3u8') }}" res='SD' label='SD' type="application/mpegURL" />
                        <source src="{{ asset('/storage/videos/b34081a9-432f-4d9a-80be-63356d1048d2/b34081a9-432f-4d9a-80be-63356d1048d2_0_100.m3u8') }}" res='MD'  label='MD' type="application/mpegURL" />
                        <source src="{{ asset('/storage/videos/b34081a9-432f-4d9a-80be-63356d1048d2/b34081a9-432f-4d9a-80be-63356d1048d2_0_100.m3u8') }}" res='HD' selected="true" label='HD' type="application/mpegURL" />
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />


@endsection

@section('scripts')
    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>


@endsection --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Video.js + hls.js</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"><!-- https://getbootstrap.com -->
    <link href="https://vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet"><!-- https://videojs.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-seek-buttons/dist/videojs-seek-buttons.css">
    <style type="text/css">
        .video-js {
            font-size: 1rem;
        }

* {
	box-sizing: border-box;
}
body {
	font-family: 'Montserrat', sans-serif;
	line-height: 1.6;
	margin: 0;
	min-height: 100vh;
}
ul {
  margin: 0;
  padding: 0;
  list-style: none;
}


h2,
h3,
a {
	color: #34495e;
}

a {
	text-decoration: none;
}



.logo {
	margin: 0;
	font-size: 1.45em;
}

.main-nav {
	margin-top: 5px;

}
.logo a,
.main-nav a {
	padding: 10px 15px;
	text-transform: uppercase;
	text-align: center;
	display: block;
}

.main-nav a {
	color: #34495e;
	font-size: .99em;
}

.main-nav a:hover {
	color: #718daa;
}



.header {
	padding-top: .5em;
	padding-bottom: .5em;
	border: 1px solid #a2a2a2;
	background-color: #f4f4f4;
	-webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}


/* =================================
  Media Queries
==================================== */




@media (min-width: 769px) {
	.header,
	.main-nav {
		display: flex;
	}
	.header {
		flex-direction: column;
		align-items: center;
    	.header{
		width: 80%;
		margin: 0 auto;
		max-width: 1150px;
	}
	}

}

@media (min-width: 1025px) {
	.header {
		flex-direction: row;
		justify-content: space-between;
	}

}

    </style>
  </head>
  <body class="bg-light">
    	<header class="header">
		<h1 class="logo"><a href="#">Flexbox</a></h1>
      <ul class="main-nav">
          <li><a href="./index.html">Quality selector</a></li>
          <li><a href="./index2.html">Quality selector 2</a></li>
          <li><a href="./index3.html">Load url</a></li>
          <li><a href="./index4.html">Playlist</a></li>
        <li><a href="./index5.html">Dynamic player</a></li>
      </ul>
	</header>

    <div class="container">
        <div class="my-5 embed-responsive embed-responsive-16by9">
            <video id="video" class="embed-responsive-item video-js vjs-default-skin" width="640" height="360" autoplay controls>
                {{-- <source src="{{ asset('/storage/videos/b34081a9-432f-4d9a-80be-63356d1048d2/b34081a9-432f-4d9a-80be-63356d1048d2_0_100.m3u8') }}" res='240' label='SD' type="application/x-mpegURL" />
                        <source src="{{ asset('/storage/videos/b34081a9-432f-4d9a-80be-63356d1048d2/b34081a9-432f-4d9a-80be-63356d1048d2_0_100.m3u8') }}" res='480'  label='MD' type="application/x-mpegURL" />
                        <source src="{{ asset('/storage/videos/b34081a9-432f-4d9a-80be-63356d1048d2/b34081a9-432f-4d9a-80be-63356d1048d2_0_100.m3u8') }}" res='720' selected="true" label='HD' type="application/x-mpegURL" />
                     --}}
            </video>
        </div>

    </div>
    <script src="https://vjs.zencdn.net/5.19.2/video.js"></script><!-- https://videojs.com -->
    <script src="https://cdn.sc.gl/videojs-hotkeys/0.2/videojs.hotkeys.min.js"></script>
    <script src="{{asset('js/hls.min.js?v=v0.9.1') }}"></script><!-- https://github.com/video-dev/hls.js -->
    <script src="{{asset('js/videojs5-hlsjs-source-handler.min.js?v=0.3.1') }}"></script><!-- https://github.com/streamroot/videojs-hlsjs-plugin -->
    <script src="{{asset('js/vjs-quality-picker.js?v=v0.0.2') }}"></script><!-- https://github.com/streamroot/videojs-quality-picker -->
    <script src="https://cdn.jsdelivr.net/npm/videojs-seek-buttons/dist/videojs-seek-buttons.min.js"></script>
    <script>
        var player = videojs('video',{
            plugins:{
                hotkeys:{
                    volumeStep: 0.1,
                    seekStep: 5,
                    enableModifiersForNumbers: false
                },
                seekButtons:{
                    forward: 10,
                    back: 10
                },


            }
        });

        player.qualityPickerPlugin();

        player.src([
            {
                src: "{{ asset('/storage/videos/'.$video->id.'/'.$video->id.'.m3u8') }}",
                // src:'https://multiplatform-f.akamaihd.net/i/multi/will/bunny/big_buck_bunny_,640x360_400,640x360_700,640x360_1000,950x540_1500,.f4v.csmil/master.m3u8',
                type: 'application/x-mpegURL',
                label: '720P',
            }
        ]);

        player.play();
    </script>
  </body>
</html>


