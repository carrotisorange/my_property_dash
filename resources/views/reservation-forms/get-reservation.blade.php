@extends('layouts.app')
@section('title', $unit->building.' '.$unit->unit_no)
@section('content')
<div class="container-fluid">
    <div class="row">
       <div class="col-md-6">
           <h5>Tenant Information</h5>
        <table class="table table-striped">
            <tr>
                <td>Reservation Date:</td>
                <td>{{ $tenant->created_at }}</td>
            </tr>
                <tr>
                    <td>Full Name:</td>
                    <td>{{ $tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name }} 
                        @if($tenant->tenant_status === 'active')
                            <a class="badge badge-primary">{{ $tenant->tenant_status }}</a>
                        @elseif($tenant->tenant_status === 'pending')
                            <a class="badge badge-warning">{{ $tenant->tenant_status }}</a>
                        @else
                            <a class="badge badge-danger">{{ $tenant->tenant_status }}</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Property:</td>
                    <td>{{ $unit->unit_property }}</td>
                </tr>
                <tr>
                    <td>Unit No:</td>
                    <td>{{ $unit->building.' '.$unit->unit_no }}</td>
                </tr>
                <tr>
                    <td>Monthly Rent:</td>
                    <td>{{ number_format($tenant->tenant_monthly_rent, 2) }}</td>
                </tr>
                <tr>
                    <td>Contract Duration:</td>
                    <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }} <a class="badge badge-primary">{{ $tenant->has_extended }}</a>
                    </td>
                </tr>
                <tr>
                    <td>Note:</td>
                    <td>
                        {{ $tenant->tenants_note }}
                    </td>
                </tr>
            </table>
            <table class="table table-striped">
                <tr>
                    <th colspan="2" class="text-center">Other Information</th>
    
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $tenant->gender }}</td>
                </tr>
                <tr>
                    <td>Birthdate</th>
                    <td>{{ Carbon\Carbon::parse($tenant->birthdate)->format('M d Y') }}</td>
                </tr>
                <tr>
                    <td>Civil Status</td>
                    <td>{{ $tenant->civil_status }}</td>
                </tr>
                <tr>
                    <td>ID/ID Number</td>
                    <td>{{ $tenant->id_number }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $tenant->barangay.', '.$tenant->city.', '.$tenant->province.', '.$tenant->country.', '.$tenant->zip_code }}</td>
                </tr>
              
                <tr>
                    <td>Contact No</td>
                    <td>{{ $tenant->contact_no }}</td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td>{{ $tenant->email_address }}</td>
                </tr>
                <tr>
                    <th colspan="2">Person to contact in case of emergency</th>
    
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $tenant->guardian }}</td>
                </tr>
                <tr>
                    <td>Relationship with the tenant</td>
                    <td>{{ $tenant->guardian_relationship }}</td>
                </tr>
                <tr>
                    <td>Contact No</td>
                    <td>{{ $tenant->guardian_contact_no }}</td>
                </tr>
            
                <tr>
                    <th>Education Background</th>
                    <td></td>
                </tr>
                <tr>
                    <td>High School</td>
                    <td>{{ $tenant->high_school.', '.$tenant->high_school_address }}</td>
                </tr>
                <tr>
                    <td>College/University</td>
                    <td>{{ $tenant->college_school.', '.$tenant->college_school_address }}</td>
                </tr>
                <tr>
                    <td>Course/Year</td>
                    <td>{{ $tenant->course.', '.$tenant->year_level }}</td>
                </tr>
              
                <tr>
                    <th colspan="2">Employment Information</th>
    
                </tr>
                <tr>
                    <td>Employer</td>
                    <td>{{ $tenant->employer}}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $tenant->employer_address }}</td>
                </tr>
                <tr>
                    <td>Contact No</td>
                    <td>{{ $tenant->employer_contact_no }}</td>
                </tr>
    
                <tr>
                    <td>Job description</td>
                    <td>{{ $tenant->job }}</td>
                </tr>
                <tr>
                    <td>Years of employment</td>
                    <td>{{ $tenant->years_of_employment }}</td>
                </tr>
            </table>
       </div>

       <div class="col-md-6">
           <h5>Amount to be paid before moving-in...</h5>
        <table class="table">
            <tr>
                <th class="text-center">#</th>
                <th>date</th>
                <th>description</th>
                <th>amount</th>
            </tr>
            <?php $ctr = 1; ?>
            @foreach ($billings as $item)
            <tr>
                <th class="text-center">{{ $ctr++ }}</th>
                <td>{{ Carbon\Carbon::parse($item->billing_date)->format('M d Y') }}</td>
                <td>{{ $item->billing_desc }}</td>
                <td>{{ number_format($item->billing_amt,2) }}</td>
            </tr>  
            @endforeach
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <th>{{ number_format($billings->sum('billing_amt'),2) }}</th>
            </tr>
        </table>
       </div>
    </div>
</div>
@endsection








