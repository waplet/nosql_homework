<?php

namespace App\Listeners;

use App\Events\LogAdd;
use App\Models\ErrorLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogAdd  $event
     * @return void
     */
    public function handle(LogAdd $event)
    {
        $errorLog = new ErrorLog();
        $errorLog->creation_date = $event->temporaryLog->creation_date;
        $errorLog->project_id = $event->temporaryLog->project_id;
        $errorLog->severity = $event->temporaryLog->severity;
        $data = $event->temporaryLog->data;
        $errorLog->file = isset($data['file']) ? $data['file'] : '';
        $errorLog->method = isset($data['method']) ? $data['method'] : '';
        $errorLog->request_data = $event->temporaryLog->data;

        if ($errorLog->save()) {
            $event->temporaryLog->delete();
        } else {
            throw new \ErrorException("Could not save error log");
        }
    }
}