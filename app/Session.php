<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $primaryKey = 'session_id';

    protected $fillable = [
                            'session_last_login',
                            'session_last_logout',
                            'session_last_login_ip',                           
    ];
    
}
