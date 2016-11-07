<?php

namespace App\Jobs;

use App\Models\ErrorLog;
use App\Models\Queue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransferLog implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $temporary;

    /**
     * Create a new job instance.
     *
     * @param Queue $temporary
     */
    public function __construct(Queue $temporary)
    {
        $this->temporary = $temporary;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $errorLog = new ErrorLog();
        $errorLog->creation_date = $this->temporary->creation_date;
        $errorLog->project_id = $this->temporary->project_id;
        $errorLog->severity = $this->temporary->severity;
        $errorLog->file = $this->temporary->data['file'];
        $errorLog->method = $this->temporary->data['method'];
        $errorLog->request_data = $this->temporary->data;

        $errorLog->save();

        $this->temporary->delete();
    }
}
