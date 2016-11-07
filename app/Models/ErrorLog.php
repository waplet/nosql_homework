<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ErrorLog extends Model
{
    protected $collection = 'error_log';

    const LOG = 0;
    const DEBUG = 1;
    const NOTICE = 2;
    const WARNING = 3;
    const ERROR = 4;
    const FATAL = 5;
    const CRITICAL = 6;
    const APOCALYPSE = 7;
    const DEFAULT = self::LOG;

    protected $fillable = [
        'created_at',
        'project_id',
        'severity',
        'file',
        'method',
        'message',
        'request_data',
    ];

    protected $dates = [
        'creation_date'
    ];
}
