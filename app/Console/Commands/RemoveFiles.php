<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\File;
use Carbon\Carbon;

class RemoveFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removing old files';

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
        $files = File::where('created_at', '<', Carbon::now()->subHours(1))->get();

        foreach($files as $file)
        {
            $file->remove();
        }
    }
}
