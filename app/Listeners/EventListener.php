<?php

namespace App\Listeners;

use App\Events\LogAdd;
use App\Events\TriggerInvoice;
use App\Models\ErrorLog;
use App\Models\Project;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class EventListener
{
    public function subscribe($events)
    {
        $events->listen(
            LogAdd::class,
            '\App\Listeners\EventListener@onLogAdd'
        );

        $events->listen(
            TriggerInvoice::class,
            '\App\Listeners\EventListener@onTriggerInvoice'
        );
    }
    /**
     * Handle the event.
     *
     * @param  LogAdd $event
     * @throws \ErrorException
     */
    public function onLogAdd(LogAdd $event)
    {
        if ($event->temporaryLog->is_logged == 1) {
            return;
        }

        $errorLog = new ErrorLog();
        $errorLog->creation_date = $event->temporaryLog->creation_date;
        $errorLog->project_id = $event->temporaryLog->project_id;
        $errorLog->severity = $event->temporaryLog->severity;
        $data = $event->temporaryLog->data;
        $errorLog->file = isset($data['file']) ? $data['file'] : '';
        $errorLog->message = isset($data['message']) ? (is_array($data['message']) ? json_encode($data['message']) : (string)$data['message']) : '';
        $errorLog->request_data = $event->temporaryLog->data;

        if ($errorLog->save()) {
            // $event->temporaryLog->delete();
            $event->temporaryLog->is_logged = 1;
            $event->temporaryLog->update();

            // Get project
            $project = Project::find($errorLog->project_id);
            if (!$project) {
                Log::alert('Project not found with id - ' . $errorLog->project_id);
            } else {
                // If project is in booking system, let's trigger event for creating an invoice
                if ($project->has_booking) {
                    event(new TriggerInvoice($project->name, $errorLog->id));
                }
            }
        } else {
            throw new \ErrorException("Could not save error log");
        }
    }

    public function onTriggerInvoice(TriggerInvoice $event)
    {
        $data = [
            'name' => $event->getCompanyName(),
            // 'company_name' => $event->getCompanyName(),
            'log_id' => $event->getLogId(),
            'url' => url('/log/' . $event->getLogId()),
            'amount' => '50',
        ];

        $bookingAppUrl = config('services.booking_app.url') . '?' . http_build_query($data);
        // HTTP REQUEST FOR SHEROKUAPP

        try {
            $client = new Client();
            // $params = [
            //     'form_params' => $data
            // ];

            // $res = $client->request('POST', $bookingAppUrl, $params);
            $res = $client->request('GET', $bookingAppUrl);
            Log::info("Invoice triggered for error log: " . $event->getLogId());
        } catch (\Exception $ex) {
            throw new \Exception("Could not make request to Booking App - " . $bookingAppUrl);
            // do nothing
        }

    }
}
