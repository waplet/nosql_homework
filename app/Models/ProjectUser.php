<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ProjectUser extends Model
{
    protected $collection = 'project_user';

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
