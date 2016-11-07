<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class User extends MongoUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'admin' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->admin == true;
    }
}
