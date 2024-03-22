<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $image_path;

    /**
     * Create a new job instance.
     */
    public function __construct($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $image = Storage::get($this->image_path);

        $img = Image::make($image);
        $img->resize(700, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream('jpg');

        Storage::put($this->image_path, $img);

        // $img = Image::make('storage/' . $this->image_path);
        //     $img->resize(700, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });
        //     $img->save('storage/' . $this->image_path, null, 'jpg');
    }
}
