@extends('layouts.app')
@section('title', $unit->building.' '.$unit->unit_no)
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-12">
           <p>Tenant information</p>
        <table class="table table-striped">
            <tr>
                <th>Date of reservation</th>
                <td>{{ $tenant->created_at }}</td>
            </tr>
                <tr>
                    <th>Full Name</th>
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
                    <th>Property</th>
                    <td>{{ $unit->unit_property }}</td>
                </tr>
                <tr>
                    <th>Unit No</th>
                    <td>{{ $unit->building.' '.$unit->unit_no }}</td>
                </tr>
                <tr>
                    <th>Monthly Rent</th>
                    <td>{{ number_format($tenant->tenant_monthly_rent, 2) }}</td>
                </tr>
                <tr>
                    <th>Contract Duration</th>
                    <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }} <a class="badge badge-primary">{{ $tenant->has_extended }}</a>
                    </td>
                </tr>
            </table>
       
           <p>Breakdowns of the amount to be paid moving-in</p>
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
    <br>
    <div class="row">
        <div class="col-md-12">
          
            <h5 class="text-center"> {{ $tenant->tenants_note }}</h5>
        </div>
    </div>
</div>
@endsection








