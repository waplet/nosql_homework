<?php

namespace App\Console\Commands;

use App\Events\LogAdd;
use App\Models\Queue;
use Illuminate\Console\Command;

class DispatchQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command dispatches queue\'s items to the main log table';

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
        $queueItems = Queue::take(100)->get();

        foreach ($queueItems as $queue) {
            // die(dump($queue));
            event(new LogAdd($queue));
        }
    }
}