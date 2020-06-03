<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $primaryKey = 'tenant_id';
    
    protected $fillable =   [
                                'unit_tenant_id',
                                'tenant_unique_id',
                                'first_name',
                                'middle_name',
                                'last_name',
                                'birthate',
                                'gender',
                                'civil_status',
                                'id_number',
                                'country',
                                'province',
                                'city',
                                'barangay',
                                'email_address',
                                'contact_no',
                                 
                                'year_level', 
                                'tenant_monthly_rent',
                                'tenant_status',
                                'movein_date',
                                'moveout_date',
                                'renewal_history',
                                'guardian',
                                'guardian_relationship',
                                'guardian_contact_no',
                                'type_of_tenant',
                                'high_school',
                                'high_school_address',
                                'college_school',
                                'college_school_address',
                                'course',
                                'employer',
                                'job',
                                'years_of_employment',
                                'employer_contact_no',
                                'zip_code',
                                
                                'actual_move_out_date',
                                'reason_for_moving_out',
                                'has_extended',
                                'tenants_note',
                            ];

    public function units()
    {
        return $this->hasMany('App\Tenant', 'unit_tenant_id');
    }
}
