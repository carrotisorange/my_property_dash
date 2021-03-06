<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'properties';

    protected $primaryKey = 'property_id';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'type',
        'ownership',
        'status',
        'address',
        'country',
        'zip'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function units()
    {
        return $this->hasMany('App\Unit', 'property_id_foreign')->orderBy('floor_no', 'asc')->orderBy('unit_no', 'asc');
    }

    public function personnels()
    {
        return $this->hasMany('App\Personnel', 'property_id_foreign');
    }

    
}
