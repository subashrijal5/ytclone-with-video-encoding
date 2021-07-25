<?php

namespace App\Console\Commands;

use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoEncode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:encode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encode Video to m3u8';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $low = (new X264('aac'))->setKiloBitrate(250);
        $mid = (new X264('aac'))->setKiloBitrate(500);
        $high = (new X264('aac'))->setKiloBitrate(1000);
        FFMpeg::fromDisk('video-temp')->open('sample.mp4')
            ->exportForHLS()
            ->addFormat($low, function ($filters) {
                $filters->resize(360, 240);
            })->addFormat($mid, function ($filters) {
                $filters->resize(640, 480);
            })->addFormat($high, function ($filters) {
                $filters->resize(1280, 720);
            })->toDisk('video-temp')
            ->onProgress(function ($progress) {
                $this->info("Progress: {$progress}%");
            })
            ->save('video/file.m3u8');
    }
}
