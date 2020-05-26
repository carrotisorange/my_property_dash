<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use Searchable;

    protected $primaryKey = 'unit_id';

    

    
}
