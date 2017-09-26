<?php

namespace App\Console\Commands;

use App\Image;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Intervention;

class PasteCopyright extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paste:copyright';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert the copyright image on each full resolution image';

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
     * @return mixed
     */
    public function handle()
    {
        $imgs = Image::all();
        foreach($imgs as $img){
            $img->pasteCopyright();
            echo "Copyright pasted on image $img->id\n";
        }
    }
}
