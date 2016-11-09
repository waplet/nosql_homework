<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Queue extends Model
{
    protected $collection = 'queue';

    public static $severities = [
        "LOG",
        "DEBUG",
        "NOTICE",
        "WARNING",
        "ERROR",
        "FATAL",
        "CRITICAL",
        "APOCALYPSE",
    ];

    const DEFAULT = 0;

    protected $fillable = [
        'created_at',
        'project_id',
        'severity',
        'data',
    ];

    protected $dates = [
        'creation_date'
    ];

    public static function getSeverityName($severity)
    {
        if (array_key_exists($severity, self::$severities)) {
            return self::$severities[$severity];
        }

        return "UNKNOWN ( " . $severity . " )";
    }
}
