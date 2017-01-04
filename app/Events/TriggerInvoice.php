<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class TriggerInvoice
{
    use InteractsWithSockets, SerializesModels;

    protected $companyName = '';
    protected $logId = '';

    /**
     * Create a new event instance.
     *
     * @param $companyName
     * @param $logId
     */
    public function __construct($companyName, $logId)
    {
        $this->companyName = $companyName;
        $this->logId = $logId;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getLogId()
    {
        return $this->logId;
    }
}
