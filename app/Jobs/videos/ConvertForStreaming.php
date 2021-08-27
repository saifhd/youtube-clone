<?php

namespace App\Jobs\videos;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $video;
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $lowBitrate = (new X264('aac'))->setKiloBitrate(250);
        $midBitrate = (new X264('aac'))->setKiloBitrate(500);
        $highBitrate = (new X264('aac'))->setKiloBitrate(1000);
        $f = FFMpeg::fromDisk('public')
        ->open($this->video->path)
        ->exportForHLS()
        ->onProgress(function($percentage){
            $this->video->percentage=$percentage;
            $this->video->update();
            // echo $percentage;
            // echo 123;
        })
            ->addFormat($lowBitrate,function($media) {
                $media->addFilter('scale=640:480');
            })
            ->addFormat($midBitrate,function($media) {

                $media->resize(960, 720);
            })
            ->addFormat($highBitrate,function ($media) {
                $media->addFilter(function ($filters, $in, $out) {
                
                    $filters->custom($in, 'scale=1920:1200', $out); // $in, $parameters, $out
                });
            })
            ->toDisk('public')
            ->save('videos/' . $this->video->id . '/' . $this->video->id . '.m3u8');

    }
}
