<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Project extends Model
{
    protected $collection = 'project';

    static $projects = [];

    public static function getProjectName($projectId, $force = false)
    {
        // die(dump($projectId));
        if (array_key_exists($projectId, self::$projects) && !$force) {
            return self::$projects[$projectId];
        }

        $project = Project::find($projectId);

        if(!$project) {
            self::$projects[$projectId] = "UNKNOWN ( " . $projectId . " )";
        } else {
            self::$projects[$projectId] = $project->name;
        }

        return self::$projects[$projectId];
    }
}
