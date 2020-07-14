<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use Searchable;

    protected $primaryKey = 'unit_id';

    protected $fillable = [
                            'unit_id',
                            'unit_no',
                            'unit_unit_owner_id',
                            'floor_no',
                            'beds',
                            'monthly_rent',
                            'egr',
                            'status',
                            'type_of_units',
                            'discount',
                            'unit_property',
                            'building',
                           
    ];

    public function unit_owner()
    {
        return $this->belongsTo('App\UnitOwner', 'unit_owner_id');
    }

    
}
