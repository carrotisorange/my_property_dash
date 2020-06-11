@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-dashboard-tab" data-toggle="pill" href="#dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true"><i class="fas fa-tachometer-alt"></i>&nbsp&nbspDashboard</a>
            @if(Auth::user()->user_type === 'admin')
            <a class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="#users" role="tab" aria-controls="v-pills-users" aria-selected="false"><i class="fas fa-user-secret"></i>&nbsp&nbspUsers</a>
            <input type="hidden" id="count_units" value="{{ $units->count() }}">
            <input type="hidden" id="current_user" value="{{ Auth::user()->user_type }}">
            <a class="nav-link" id="v-pills-units-tab" data-toggle="pill" href="#units" role="tab" aria-controls="v-pills-units" aria-selected="false"><i class="fas fa-home"></i>&nbsp&nbspUnits <span class="badge badge-light">{{ $units->count() }}</span></a>
            @foreach ($units_per_building as $item)
            <a class="nav-link" id="pills-{{ $item->building }}-tab" data-toggle="pill" href="#{{ $item->building }}" role="tab" aria-controls="pills-{{ $item->building }}" aria-selected="false">&nbsp&nbsp&nbsp&nbsp - {{ $item->building }} <span class="badge badge-light">{{ $item->count }}</span> </a>
            @endforeach


            <a class="nav-link" id="v-pills-tenants-tab" data-toggle="pill" href="#tenants" role="tab" aria-controls="v-pills-tenants" aria-selected="false"><i class="fas fa-user"></i>&nbsp&nbspTenants  <span class="badge badge-light">{{ $tenants->count() }}</span></a>
            <a class="nav-link" id="v-pills-investors-tab" data-toggle="pill" href="#investors" role="tab" aria-controls="v-pills-investors" aria-selected="false"><i class="fas fa-user-tie"></i>&nbsp&nbspUnit Owners <span class="badge badge-light">{{ $investors->count() }}</span> </a>
            <a class="nav-link" id="v-pills-joborders-tab" data-toggle="pill" href="#joborders" role="tab" aria-controls="v-pills-joborders" aria-selected="false"><i class="fas fa-tools"></i>&nbspJob Orders</a>
            @else
            <a href="#" onclick="return false;" class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="#users" role="tab" aria-controls="v-pills-users" aria-selected="false"> <i class="fas fa-user-secret"></i>&nbsp&nbspUsers</a>
            <a href="#" onclick="return false;" class="nav-link" id="v-pills-units-tab" data-toggle="pill" href="#units" role="tab" aria-controls="v-pills-units" aria-selected="false"> <i class="fas fa-door-closed"></i>&nbsp&nbspUnits</a>
            <a href="#" onclick="return false;" class="nav-link" id="v-pills-investors-tab" data-toggle="pill" href="#investors" role="tab" aria-controls="v-pills-investors" aria-selected="false"><i class="fas fa-user-tie"></i>&nbsp&nbspInvestors</a>
            <a href="#" onclick="return false;" class="nav-link" id="v-pills-tenants-tab" data-toggle="pill" href="#tenants" role="tab" aria-controls="v-pills-tenants" aria-selected="false"><i class="fas fa-user"></i>&nbsp&nbspTenants</a>
            @endif
            @if(Auth::user()->user_type === 'billing')
            <input type="hidden" id="current_user" value="{{ Auth::user()->user_type }}">
            <input type="hidden" id="posted_bills_this_month_for_rent" value="{{ $posted_bills_this_month_for_rent }}">
            <input type="hidden" id="delinquent_accounts" value="{{ $delinquent_accounts->count() }}">
            <a class="nav-link" id="v-pills-billings-tab" data-toggle="pill" href="#billings" role="tab" aria-controls="v-pills-billings" aria-selected="false"><i class="fas fa-file-invoice-dollar"></i>&nbsp&nbspBillings</a>
            @else
            <a href="#" onclick="return false;"  class="nav-link" id="v-pills-billings-tab" data-toggle="pill" href="#billings" role="tab" aria-controls="v-pills-billings" aria-selected="false"><i class="fas fa-file-invoice-dollar"></i>&nbsp&nbspBillings</a>
            @endif
            @if(Auth::user()->user_type === 'treasury')
            <a class="nav-link" id="v-pills-payments-tab" data-toggle="pill" href="#payments" role="tab" aria-controls="v-pills-payments" aria-selected="false"><i class="fas fa-dollar-sign"></i>&nbsp&nbspPayments</a>
            @else
            <a href="#" onclick="return false;" class="nav-link" id="v-pills-payments-tab" data-toggle="pill" href="#payments" role="tab" aria-controls="v-pills-payments" aria-selected="false"><i class="fas fa-dollar-sign"></i>&nbsp&nbspPayments</a>
            @endif
          </div>
        </div>
        <div class="col-10">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Dashboard <i class="fas fa-tachometer-alt"></i></h4>
                        <div class="row">
                            <div class="col">
                            @if(Auth::user()->user_type === 'admin')
                               <p class="text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUnit" data-whatever="@mdo"><i class="fas fa-plus"></i> room</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMultipleUnits" data-whatever="@mdo"><i class="fas fa-plus"></i> multiple rooms</button>
                               </p>
                            @endif
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        Total Units
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">{{ $units->count() }}
                                            <span class="text-right"><p><i class="fas fa-home"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        Commercial Units
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">{{ $commercial_units->count() }}
                                            <span class="text-right"><p><i class="fas fa-hotel"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-primary">
                                    <div class="card-header">
                                        Leasing Units
                                    </div>
                                    <div class="card-body">
                                        <h1 class="text-center">{{ $leasing_units->count() }}
                                            <span class="text-right"><p><i class="fas fa-laptop-house"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        Residential Units
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">{{ $residential_units->count() }}
                                            <span class="text-right"><p><i class="fas fa-house-user"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="card bg-success">
                                    <div class="card-header">
                                        Active Tenants
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">{{ $active_tenants->count() }}
                                            <span class="text-right"><p><i class="fas fa-user-check"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        Pending Tenants
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">{{ $pending_tenants->count() }}
                                            <span class="text-right"><p><i class="fas fa-user-clock"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        Unit Owners
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">{{ $investors->count() }}
                                            <span class="text-right"><p><i class="fas fa-user-tie"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger">
                                    <div class="card-header">
                                        Pending Job Orders
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">0
                                            <span class="text-right"><p><i class="fas fa-tools"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <?php $ctr = 1; ?>
                                <h4>tenants to watch out </h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>name</th>
                                        <th>contact no</th>
                                        <th>unit no</th>
                                        <th colspan="3"></th>
                                    </tr>

                                   @foreach($tenants_to_watch_out as $item)
                                   <?php
                                            $diffInMonths =  number_format(Carbon\Carbon::now()->floatDiffInMonths(Carbon\Carbon::parse($item->moveout_date), false));
                                            $diffInDays =  number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->moveout_date), false));
                                    ?>
                                    @if($diffInDays <= 30 )
                                    <tr>
                                        <th class="text-center">{{ $ctr++ }}</th>
                                        <td>
                                            @if (Auth::user()->user_type === 'admin')
                                            <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                            @elseif(Auth::user()->user_type === 'treasury')
                                            <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/payments">{{ $item->first_name.' '.$item->last_name }}</a>
                                            @else
                                            {{ $item->first_name.' '.$item->last_name }}
                                            @endif
                                        </td>
                                        <td>{{ $item->contact_no }}</td>
                                        <td>{{ $item->building.' '.$item->unit_no }}</td>
                                        <td colspan="2">
                                            @if($diffInDays <= -1)
                                            <a class="badge badge-danger">contract has lapsed {{ $diffInDays*-1 }} days ago</a>
                                             @else
                                            <a class="badge badge-warning">contract expires in {{ $diffInDays }} days </a>
                                             @endif
                                        </td>
                                        <td>{{ $item->tenants_note  }}</td>
                                   </tr>
                                    @endif
                                   @endforeach
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>reservations ({{ $reservations->count() }}) </h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>name</th>
                                        <th>unit no</th>
                                        <th>reserved via</th>
                                        <th>contact no</th>
                                        <th>reservation date</th>
                                    </tr>
                                   <?php $ctr = 1; ?>
                                   @foreach($reservations as $item)
                                    <tr>
                                        <th class="text-center">{{ $ctr++ }}</th>
                                         <td>
                                            @if (Auth::user()->user_type === 'admin')
                                            <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                            @elseif(Auth::user()->user_type === 'treasury')
                                            <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/payments">{{ $item->first_name.' '.$item->last_name }}</a>
                                            @else
                                            {{ $item->first_name.' '.$item->last_name }}
                                            @endif
                                        </td>
                                        <td>{{ $item->building.' '.$item->unit_no }}</td>

                                        <td>{{ $item->contact_no }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                                    </tr>
                                   @endforeach
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        {!! $renewed_chart->container() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>tenants' retention</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>name</th>
                                                <th>unit no</th>
                                                <th></th>
                                            </tr>
                                           <?php $ctr = 1; ?>
                                           @foreach($renewed_contracts->take(3) as $item)
                                            <tr>
                                                <th class="text-center">{{ $ctr++ }}</th>
                                                <td>
                                                    @if(Auth::user()->user_type === 'admin')
                                                    <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                                    @elseif(Auth::user()->user_type === 'treasury')
                                                    <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a>
                                                    @else
                                                    {{ $item->first_name.' '.$item->last_name }}
                                                    @endif
                                                </td>
                                                <td>{{ $item->building.' '.$item->unit_no }}</td>
                                                <?php $renewal_history = explode(",", $item->renewal_history); ?>
                                                <td><a class="badge badge-success">{{ $item->has_extended }} ({{ count($renewal_history)-1 }}x) {{ number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->movein_date)) ) }} days ago</a></td>
                                           </tr>
                                           @endforeach
                                           @foreach($terminated_contracts->take(3) as $item)
                                           <tr>
                                               <th class="text-center">{{ $ctr++ }}</th>
                                               <td>
                                                   @if(Auth::user()->user_type === 'admin')
                                                   <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                                   @elseif(Auth::user()->user_type === 'treasury')
                                                   <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a>
                                                   @else
                                                   {{ $item->first_name.' '.$item->last_name }}
                                                   @endif
                                               </td>
                                               <td>{{ $item->building.' '.$item->unit_no }}</td>
                                               <td><a class="badge badge-danger" >terminated {{ number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->moveout_date)) ) }} days ago</a></td>
                                          </tr>
                                          @endforeach
                                        </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        Move-in rate  <span style="float:right;">Occupancy ({{ number_format($occupied_units->count()/$units->count() * 100,2) }} %) </span>
                                    </div> --}}
                                    <div class="card-body">
                                        {!! $movein_rate->container() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>recent tenants</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>name</th>

                                                <th>unit no</th>
                                                <th></th>
                                            </tr>
                                           <?php $ctr = 1; ?>
                                           @foreach($recent_movein as $item)
                                            <tr>
                                                <th class="text-center">{{ $ctr++ }}</th>
                                                <td>
                                                    @if(Auth::user()->user_type === 'admin')

                                                    <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a> <a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @elseif(Auth::user()->user_type === 'treasury')

                                                    <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a><a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @else

                                                    {{ $item->first_name.' '.$item->last_name }}<a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @endif
                                                </td>

                                                <td>{{ $item->building.' '.$item->unit_no }}</td>
                                                <td><a class="badge badge-primary">{{ number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->movein_date)) ) }} days ago</a></td>
                                           </tr>
                                           @endforeach
                                        </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        Move-in rate  <span style="float:right;">Occupancy ({{ number_format($occupied_units->count()/$units->count() * 100,2) }} %) </span>
                                    </div> --}}
                                    <div class="card-body">
                                        {!! $moveout_rate->container() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>terminated contracts</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>name</th>
                                                <th>unit no</th>
                                                <th>reason</th>
                                                <th></th>
                                            </tr>
                                           <?php
                                             $ctr = 1;
                                           ?>
                                            @foreach($terminated_contracts->take(5) as $item)
                                            <tr>
                                                <th class="text-center">{{ $ctr++ }}</th>
                                                <td>
                                                    @if(Auth::user()->user_type === 'admin')
                                                    <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a> <a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @elseif(Auth::user()->user_type === 'treasury')
                                                    <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a><a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @else
                                                    {{ $item->first_name.' '.$item->last_name }}<a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @endif
                                                </td>
                                                <td>{{ $item->building.' '.$item->unit_no }}</td>
                                                <td>{{ $item->reason_for_moving_out }}</td>
                                                <td><a class="badge badge-danger">{{ number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->moveout_date)) ) }} days ago</a></td>
                                           </tr>
                                           @endforeach
                                        </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        {!! $collection_rate->container() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>delinquents ({{ $delinquent_accounts->count() }})</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>name</th>
                                                <th>unit no</th>
                                                <th>balance</th>
                                            </tr>
                                            <?php
                                            $ctr = 1;
                                            ?>
                                            @foreach ($delinquent_accounts as $item)
                                            <tr>
                                                <th class="text-center">{{ $ctr++ }}</th>
                                                <td><a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a></td>
                                                <td>{{$item->building.' '.$item->unit_no }}</td>
                                                <td>{{ number_format($item->total_bills,2) }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="units" role="tabpanel" aria-labelledby="v-pills-units-tab">
                <div class="card">
                    <div class="card-body">
                <ul class="nav nav-pills mb-3 text-right" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-home"></i> all <span class="badge badge-light">{{ $units->count() }}</span></a>
                </li>
                @foreach ($units_per_status as $item)
                    <li class="nav-item">
                        @if($item->status==='occupied')
                        <a class="nav-link" id="pills-{{ $item->status }}-tab" data-toggle="pill" href="#{{ $item->status }}" role="tab" aria-controls="pills-{{ $item->status }}" aria-selected="false"><i class="fas fa-house-user"></i> {{ $item->status }} <span class="badge badge-light">{{ $item->count }}</span> </a>
                        @elseif($item->status==='vacant')
                        <a class="nav-link" id="pills-{{ $item->status }}-tab" data-toggle="pill" href="#{{ $item->status }}" role="tab" aria-controls="pills-{{ $item->status }}" aria-selected="false"><i class="fas fa-home"></i> {{ $item->status }} <span class="badge badge-light">{{ $item->count }}</span> </a>
                        @else
                        <a class="nav-link" id="pills-{{ $item->status }}-tab" data-toggle="pill" href="#{{ $item->status }}" role="tab" aria-controls="pills-{{ $item->status }}" aria-selected="false"><i class="fas fa-laptop-house"></i> {{ $item->status }} <span class="badge badge-light">{{ $item->count }}</span> </a>
                        @endif
                    </li>
                @endforeach
                {{--<li class="nav-item">
                    <a class="nav-link" href="#/">|</a>
                </li>
                 @foreach ($units_per_building as $item)
                <li class="nav-item">
                    <a class="nav-link" id="pills-{{ $item->building }}-tab" data-toggle="pill" href="#{{ $item->building }}" role="tab" aria-controls="pills-{{ $item->building }}" aria-selected="false">{{ $item->building }} <span class="badge badge-light">{{ $item->count }}</span> </a>
                </li>
                @endforeach --}}
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row border-rounded">
                        <table class="table">
                            <tr>
                                <td>
                                    @foreach ($units as $item)
                                        @if($item->status === 'vacant')
                                            <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-secondary">
                                                <i class="fas fa-home fa-2x"></i>
                                                <br>
                                                <font size="-3" >{{ $item->unit_no }} </font>
                                            </a>
                                        @elseif($item->status=== 'reserved')
                                            <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-warning">
                                                <i class="fas fa-home fa-2x"></i>
                                                <br>
                                                <font size="-3">{{ $item->unit_no }} </font>
                                            </a>
                                        @elseif($item->status=== 'occupied')
                                            <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-primary">
                                                <i class="fas fa-home fa-2x"></i>
                                                <br>
                                                <font size="-3">{{ $item->unit_no }} </font>
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <br>
                            </tr>
                        </table>
                </div>
                </div>
                @foreach ($units_per_status as $item)
                <div class="tab-pane fade" id="{{ $item->status }}" role="tabpanel" aria-labelledby="pills-{{ $item->status }}-tab">
                    <div class="row border-rounded">
                        <table class="table">
                            <tr>
                                <td>
                                    @foreach ($units as $unit)
                                        @if($unit->status === $item->status)
                                                @if($unit->status === 'vacant')
                                                <a title="{{ $unit->type_of_units }}" href="/units/{{$unit->unit_id}}" class="btn btn-secondary">
                                                    <i class="fas fa-home fa-2x"></i>
                                                    <br>
                                                    <font size="-3">{{ $unit->unit_no }}</font>
                                                </a>
                                                @elseif($item->status=== 'reserved')
                                                <a title="{{ $unit->type_of_units }}" href="/units/{{$unit->unit_id}}" class="btn btn-warning">
                                                    <i class="fas fa-home fa-2x"></i>
                                                    <br>
                                                    <font size="-3">{{ $unit->unit_no }} </font>
                                                </a>
                                                @elseif($item->status=== 'occupied')
                                                <a title="{{ $unit->type_of_units }}" href="/units/{{$unit->unit_id}}" class="btn btn-primary">
                                                    <i class="fas fa-home fa-2x"></i>
                                                    <br>
                                                    <font size="-3">{{ $unit->unit_no }} </font>
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <br>
                            </tr>
                        </table>
                </div>
                </div>
                @endforeach
              </div>
                    </div>
                </div>
            </div>


            @foreach ($units_per_building as $item)
            <div class="tab-pane fade" id="{{ $item->building }}" role="tabpanel" aria-labelledby="pills-{{ $item->building }}-tab">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3 text-right" id="pills-tab" role="tablist">
                            @foreach ($units_per_status as $status)
                            <li class="nav-item">
                                @if($status->status==='occupied')
                                <a class="nav-link" id="pills-{{ $item->building.'#'.$status->status }}-tab" data-toggle="pill" href="#{{ $item->building.'#'.$status->status }}" role="tab" aria-controls="pills-{{ $item->building.'#'.$status->status }}" aria-selected="false"><i class="fas fa-house-user"></i> {{ $status->status }} <span class="badge badge-light"></span></a>
                                @elseif($status->status==='vacant')
                                <a class="nav-link" id="pills-{{ $item->building.'#'.$status->status }}-tab" data-toggle="pill" href="#{{ $item->building.'#'.$status->status }}" role="tab" aria-controls="pills-{{ $item->building.'#'.$status->status }}" aria-selected="false"><i class="fas fa-home"></i>  {{ $status->status }} <span class="badge badge-light"></span></a>
                                @else
                                <a class="nav-link" id="pills-{{ $item->building.'#'.$status->status }}-tab" data-toggle="pill" href="#{{ $item->building.'#'.$status->status }}" role="tab" aria-controls="pills-{{ $item->building.'#'.$status->status }}" aria-selected="false"><i class="fas fa-laptop-house"></i> {{ $status->status }} <span class="badge badge-light"></span></a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                            <table class="table">
                                <tr>
                                    <td>
                                        @foreach ($units as $unit)
                                            @if($unit->building === $item->building)
                                                    @if($unit->status === 'vacant')
                                                    <a title="{{ $unit->type_of_units }}" href="/units/{{$unit->unit_id}}" class="btn btn-secondary">
                                                        <i class="fas fa-home fa-2x"></i>
                                                        <br>
                                                        <font size="-3">{{ $unit->unit_no }} </font>
                                                    </a>
                                                    @elseif($unit->status=== 'reserved')
                                                    <a title="{{ $unit->type_of_units }}" href="/units/{{$unit->unit_id}}" class="btn btn-warning">
                                                        <i class="fas fa-home fa-2x"></i>
                                                        <br>
                                                        <font size="-3">{{ $unit->unit_no }} </font>
                                                    </a>
                                                    @elseif($unit->status=== 'occupied')
                                                    <a title="{{ $unit->type_of_units }}" href="/units/{{$unit->unit_id}}" class="btn btn-primary">
                                                        <i class="fas fa-home fa-2x"></i>
                                                        <br>
                                                        <font size="-3">{{ $unit->unit_no }} </font>
                                                    </a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <br>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- display tenants --}}
            <div class="tab-pane fade" id="tenants" role="tabpanel" aria-labelledby="v-pills-tenants-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Tenants <i class="fas fa-user"></i></h4>
                        <br>
                        <div class="justify-content-center">
                            <form action="tenants/search" method="GET" >
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="enter tenant name" value="{{ session('search_tenant') }}">
                                </div>
                            </form>
                            <br>

                                <table class="table table-striped">
                                     <tr>
                                        <th class="text-center">#</th>
                                        <th>name</th>
                                        <th>unit no</th>
                                        <th>contact no</th>
                                        <th>monthly rent</th>
                                        <th>contract expires in</th>
                                        </tr>
                                    <?php $ctr = 1;?>

                                    @foreach ($tenants as $item)
                                    <tr>
                                        <th class="text-center">{{ $ctr++ }}</th>
                                        <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                            @if($item->tenant_status === 'active')
                                            <a class="badge badge-primary">{{ $item->tenant_status }}</a>
                                            @elseif($item->tenant_status === 'inactive')
                                            <a class="badge badge-secondary">{{ $item->tenant_status }}</a>
                                            @else
                                            <a class="badge badge-warning">{{ $item->tenant_status }}</a>
                                            @endif
                                        </td>
                                        <td>{{ $item->building.' '.$item->unit_no }}</td>
                                        <td>{{ $item->contact_no }}</td>
                                        <td>{{ number_format($item->tenant_monthly_rent,2) }}</td>
                                        <td>{{   $diffInMonths =  number_format(Carbon\Carbon::now()->floatDiffInMonths(Carbon\Carbon::parse($item->moveout_date), false), 1) }} mon</td>
                                    </tr>
                                    @endforeach

                                 </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- display investors --}}
            <div class="tab-pane fade" id="investors" role="tabpanel" aria-labelledby="v-pills-investors-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Unit Owners <i class="fas fa-user-tie"></i></h4>
                        <br>
                        <div class="justify-content-center">
                            <form action="/unit_owners/search" method="GET" >
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="enter investor name" value="{{ session('search_unit_owners') }}">
                                </div>
                            </form>
                            <br>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>name</th>
                                        <th>unit no</th>
                                        <th>contact no</th>
                                        <th>contract expires on</th>
                                    </tr>
                                    </thead>
                                    <?php
                                      $ctr = 1;
                                    ?>
                                    <tbody>
                                    @foreach ($investors as $item)
                                    <tr>
                                        <th class="text-center">{{ $ctr++ }}</th>
                                        <td><a href="{{ route('show-investor',['unit_id'=> $item->unit_id, 'unit_owner_id'=>$item->unit_owner_id]) }}">{{ $item->unit_owner }} </a></td>
                                        <td>{{ $item->building.' '.$item->unit_no }}</td>
                                        <td>{{ $item->investor_contact_no }}</td>
                                       <td>{{ Carbon\Carbon::parse($item->contract_end)->format('M d Y') }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                 </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- display job orders --}}
            <div class="tab-pane fade" id="joborders" role="tabpanel" aria-labelledby="v-pills-joborders-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Job Orders <i class="fas fa-tools"></i> </h4>
                        <br>
                        <div class="justify-content-center">
                            <form action="tenants/search" method="GET" >
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="enter tenant name" value="{{ session('search_tenant') }}">
                                </div>
                            </form>
                            <br>

                                <table class="table table-striped">
                                     <tr>
                                        <th class="text-center">#</th>
                                        <th>name</th>
                                        <th>unit no</th>
                                        <th>contact no</th>
                                        <th>monthly rent</th>
                                        <th>contract expires in</th>
                                        </tr>
                                    <?php $ctr = 1;?>

                                    @foreach ($tenants as $item)
                                    <tr>
                                        <th class="text-center">{{ $ctr++ }}</th>
                                        <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                            @if($item->tenant_status === 'active')
                                            <a class="badge badge-primary">{{ $item->tenant_status }}</a>
                                            @elseif($item->tenant_status === 'inactive')
                                            <a class="badge badge-secondary">{{ $item->tenant_status }}</a>
                                            @else
                                            <a class="badge badge-warning">{{ $item->tenant_status }}</a>
                                            @endif
                                        </td>
                                        <td>{{ $item->building.' '.$item->unit_no }}</td>
                                        <td>{{ $item->contact_no }}</td>
                                        <td>{{ number_format($item->tenant_monthly_rent,2) }}</td>
                                        <td>{{   $diffInMonths =  number_format(Carbon\Carbon::now()->floatDiffInMonths(Carbon\Carbon::parse($item->moveout_date), false), 1) }} mon</td>
                                    </tr>
                                    @endforeach

                                 </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- display billings --}}
            <div class="tab-pane fade" id="billings" role="tabpanel" aria-labelledby="v-pills-billings-tab">
                <div class="card">
                    <div class="card-body">

                       <h4> Billings <i class="fas fa-file-invoice-dollar"></i></h4>
                       <form id="billingRentForm" action="/tenants/billings" method="POST">
                            @csrf
                        </form>
                        <form id="billingElectricForm" action="/tenants/billings" method="POST">
                            @csrf
                        </form>
                        <form id="billingWaterForm" action="/tenants/billings" method="POST">
                            @csrf
                        </form>
                        <form id="billingSurchargeForm" action="/tenants/billings" method="POST">
                            @csrf
                        </form>
                       <span style="float:right;">
                        <button type="submit" form="billingRentForm" class="btn btn-primary"><i class="fas fa-plus"></i> rent</button>
                        <input type="hidden" form="billingRentForm" name="billing_option" value="rent">
                        <button type="submit" form="billingElectricForm" class="btn btn-primary"><i class="fas fa-plus"></i> electric</button>
                        <input type="hidden" form="billingElectricForm" name="billing_option" value="electric">
                        <button type="submit" form="billingWaterForm" class="btn btn-primary"><i class="fas fa-plus"></i> water</button>
                        <input type="hidden" form="billingWaterForm" name="billing_option" value="water">
                        <button type="submit" form="billingSurchargeForm" class="btn btn-primary"><i class="fas fa-plus"></i> surcharge</button>
                        <input type="hidden" form="billingSurchargeForm" name="billing_option" value="surcharge">
                       </span>
                        <br><br>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Expected Collection</b>
                                    </div>
                                    <div class="card-body">
                                        <h2>{{ number_format($expected_collection,2) }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Actual Collection</b>
                                    </div>
                                    <div class="card-body">
                                        <h2>{{ number_format($actual_collection,2) }}</h2>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Uncollected Amount</b>
                                    </div>
                                    <div class="card-body">
                                        <h2>{{ number_format($uncollected_amount,2) }}</h2>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                    <h4>Delinquent Accounts</h4>
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>name</th>
                                                <th>contact no</th>
                                                <th>unit no</th>
                                                <th>amount</th>
                                            </tr>
                                            <?php
                                            $ctr = 1;
                                            ?>
                                            @foreach ($delinquent_accounts as $item)

                                            <tr>
                                                <th class="text-center">{{ $ctr++ }}</th>
                                                <td><a href="{{ route('show-billings',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a></td>
                                                <td>{{ $item->contact_no }}</td>
                                                <td>{{ $item->building.' '.$item->unit_no }}</td>
                                                <td>{{ number_format($item->total_bills,2) }}</td>
                                            </tr>
                                            @endforeach

                                        </table>
                            </div>
                    </div>
                    <br>
                    <div class="row">
                       <div class="col-md-12">
                           <h4>Recent Payments </h4>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="text-center">#</th>
                                <th>date paid</th>
                                <th>name</>
                                <th>status</th>
                                <th>unit no</th>
                                <th>description</th>
                                <th>amount</th>

                            </tr>
                           <?php
                             $ctr = 1;
                           ?>
                           @foreach ($recent_payments as $tenant)
                            <tr>
                                <th class="text-center">{{ $ctr++ }}</th>
                                <td>{{ Carbon\Carbon::parse($tenant->payment_created)->format('M d Y') }}</td>
                                <td>{{ $tenant->first_name.' '.$tenant->last_name }}</>
                                <td>{{ $tenant->tenant_status }}</td>
                                <td>{{ $tenant->building.' '.$tenant->unit_no }}</td>
                                <td>
                                @if ($tenant->payment_note === 'Security Deposit (Utilities), Security Deposit (Rent),Advance Rent')
                                    Move-in Charges
                                @else
                                {{ $tenant->payment_note }}
                                @endif
                                </td>
                                <td>{{ number_format($tenant->amt_paid,2) }}</td>
                            </tr>
                           @endforeach
                        </table>
                       </div>
                    </div>
                    </div>
                </div>
            </div>

            {{-- display payments --}}
            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="v-pills-payments-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <a class="btn btn-primary" href="/tenants/search"><i class="fas fa-plus"></i> payment</a>
                            <a class="btn btn-primary" href="/payments/all"><i class="fas fa-search-dollar"></i> see more payments</a>
                          </div>
                        </div>
                        <br>
                       <div class="row">
                           <div class="col-md-12">
                            <table class="table table-striped table-bordered">
                                <tr>
                                   <th>#</th>
                                   <th>name</th>
                                   <th>unit no</th>
                                   <th>form of payment</th>
                                   <th>amount</th>
                                   <th></th>
                               </tr>
                               <?php $ctr = 1; ?>
                               @if($payments->count() <= 0)
                               <tr>
                                   <td colspan="6" class="text-center">No payments found today!</td>
                               </tr>
                               @else
                               @foreach ($payments as $item)
                               <tr>
                                   <th>{{ $ctr++ }}</th>
                                   <td>{{ $item->first_name.' '.$item->last_name }}</td>
                                   <td>{{ $item->building.' '.$item->unit_no }}</td>
                                   <td>{{ $item->form_of_payment }}</td>
                                   <td>{{ number_format($item->amt_paid,2) }}</td>
                                   <td><a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/payments/{{ $item->payment_id }}">View Details</a></td>
                               </tr>
                               @endforeach
                               <th colspan="4">TOTAL</th>
                               <th>{{ number_format($payments->sum('amt_paid'),2) }}</th>
                               <td></td>
                               @endif
                            </table>
                           </div>
                       </div>

                        <br>
                        <div class="row">
                           <div class="col">
                                <h5> delinquent accounts</h5>
                                   <table class="table table-bordered table-striped">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>name</th>
                                            <th>unit no</th>
                                            <th>balance</th>
                                        </tr>
                                        <?php $ctr = 1; ?>
                                        @if($delinquent_accounts->count() <= 0)
                                        <tr>
                                            <td colspan="6" class="text-center">No delinquents found!</td>
                                        </tr>
                                        @else
                                        @foreach ($delinquent_accounts as $item)
                                        <tr>
                                            <th class="text-center">{{ $ctr++ }}</th>
                                            <td>{{ $item->first_name.' '.$item->last_name }}</td>
                                            <td>{{ $item->building.' '.$item->unit_no }}</td>
                                            <td>{{ number_format($item->total_bills,2) }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </table>
                           </div>
                        </div>
                       <br>
                    </div>
                </div>
            </div>

             {{-- display users --}}
             <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="v-pills-users-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Users <i class="fas fa-user-secret"></i></h4>
                        <div class="row">
                            <div class="col">

                               <p class="text-right">
                                @if($users->count() > 3)
                                <a href="#" title="Reach the limit for creating users. You can only add 4 users per property. " class="btn btn-primary"> <i class="fas fa-user-plus"></i> user</a>
                                @else
                                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"> <i class="fas fa-user-plus"></i> user</a>
                                @endif
                               </p>

                            </div>
                        </div>

                                  <div class="row">
                                    <div class="col">
                                      <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="card card-body">
                                            <form id="addUserForm" action="/users" method="POST">
                                                {{ csrf_field() }}
                                            </form>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="recipient-name" class="col-form-label"><b>name</b></label>
                                                    <input form="addUserForm" type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="col">
                                                    <label for="recipient-name" class="col-form-label"><b>email</b></label>
                                                    <input form="addUserForm" type="email" class="form-control" name="email" required>
                                                </div>
                                                <div class="col">
                                                    <label for="recipient-name" class="col-form-label"><b>user type</b></label>
                                                    <select class="form-control" form="addUserForm" name="user_type" required>
                                                        <option value="">Please select one</option>
                                                        <option value="admin">admin</option>
                                                        <option value="billing">billing</option>
                                                        <option value="manager">manager</option>
                                                        <option value="treasury">treasury</option>
                                                        <option value="root">root</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="recipient-name" class="col-form-label"><b>status</b></label>
                                                    <select class="form-control" form="addUserForm" name="status" required>
                                                        <option value="">Please select one</option>
                                                        <option value="registered">registered</option>
                                                        <option value="unregistered">unregistered</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="recipient-name" class="col-form-label"><b>property</b></label>
                                                    <input form="addUserForm" type="text" class="form-control" name="property" value="{{ Auth::user()->property }}" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="">
                                                <p class="text-right">
                                                    <button type="submit" form="addUserForm" class="btn btn-primary" ><i class="fas fa-check"></i> add</button>
                                                </p>

                                            </div>
                                        </div>
                                      </div>
                                    </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col">
                            {{-- <form action="users/search" method="GET" >
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control col-md-3" name="search" placeholder="enter user name" value="{{ session('search_user') }}">
                                    &nbsp&nbsp<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> search</button>
                                </div>
                            </form>
                            <br> --}}

                                <table class="table table-striped">
                                     <tr>
                                        <th class="text-center">#</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>user type</th>
                                        <th>status</th>
                                        <th>property</th>
                                        <th></th>
                                        </tr>
                                    <?php $ctr = 1;?>
                                    @foreach ($users as $item)
                                    <tr>
                                        <th class="text-center">{{ $ctr++ }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->user_type }}</td>
                                        <td>
                                            @if($item->status === 'registered')
                                            <a class="badge badge-success">{{ $item->status }}</a>
                                            @else
                                            <a class="badge badge-danger">{{ $item->status }}</a>
                                            @endif
                                        </td>
                                        <td>{{ $item->property }}</td>
                                        <td>
                                            @if($item->user_type === 'admin')
                                            @else
                                            <form action="/users/{{ $item->id }}" method="POST">
                                                {{ csrf_field() }}
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');" type="submit" ><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            @endif
                                      </td>
                                    </tr>
                                    @endforeach

                                 </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Room/Unit</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="addUnitForm" action="/units/add" method="POST">
                    {{ csrf_field() }}
                </form>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter name of the building</label>
                    <input form="addUnitForm" type="text" class="form-control" name="building" placeholder="Building-A" required>
                    <small class="text-danger">please put hyphen(-) between spaces</small>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the floor number of the room/unit</label>
                    <select class="form-control" form="addUnitForm" name="floor_no" id="floor_no" onkeyup="getFloorNo()" required>
                        <option value="" selected>Please select one</option>
                        <option value="G">Ground floor</option>
                        <option value="1">1st floor</option>
                        <option value="2">2nd floor</option>
                        <option value="3">3rd floor</option>
                        <option value="4">4th floor</option>
                        <option value="5">5ht floor</option>
                        <option value="6">6th floor</option>
                        <option value="7">7th floor</option>
                        <option value="8">8th floor</option>
                        <option value="9">9th floor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">select the purpose of the rooms/units</label>
                    <select form="addUnitForm" class="form-control" name="type_of_units" required>
                        <option value="" selected>Please select one</option>
                        <option value="leasing">leasing</option>
                        <option value="commercial">commercial</option>
                        <option value="residential">residential</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the unit no</label>
                    <input form="addUnitForm" type="text" class="form-control" name="unit_no" required>
                </div>


                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the number of the bed/room</label>
                    <input form="addUnitForm" type="text" class="form-control" name="beds" required>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the monthly rent of the room/unit</label>
                    <input form="addUnitForm" type="number" min="1" class="form-control" name="monthly_rent" required>
                </div>

            </div>
            <div class="modal-footer">
                <button form="addUnitForm" type="submit" class="btn btn-primary"><i class="fas fa-check"></i> create room</button>
                </div>
        </div>
        </div>
    </div>


    <div class="modal fade" id="addMultipleUnits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" >Add Multiple Rooms/Units</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="addUMultipleUnitForm" action="/units/add-multiple" method="POST">
                    {{ csrf_field() }}
                </form>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the name of the building</label>
                    <input form="addUMultipleUnitForm" type="text" class="form-control" name="building" placeholder="Building-A" required>
                    <small class="text-danger">please put hyphen(-) between spaces</small>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">select the floor number</label>
                    <select class="form-control" form="addUMultipleUnitForm" name="floor_no" id="floor_no" onkeyup="getFloorNo()" required>
                        <option value="" selected>Please select one</option>
                        <option value="G">Ground floor</option>
                        <option value="1">1st floor</option>
                        <option value="2">2nd floor</option>
                        <option value="3">3rd floor</option>
                        <option value="4">4th floor</option>
                        <option value="5">5ht floor</option>
                        <option value="6">6th floor</option>
                        <option value="7">7th floor</option>
                        <option value="8">8th floor</option>
                        <option value="9">9th floor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">select the purpose of the rooms/units</label>
                    <select form="addUMultipleUnitForm" class="form-control" name="type_of_units" required>
                        <option value="" selected>Please select one</option>
                        <option value="leasing">leasing</option>
                        <option value="commercial">commercial</option>
                        <option value="residential">residential</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the number of beds of the rooms/units</label>
                    <input form="addUMultipleUnitForm" type="number" class="form-control" name="beds" required>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the number of rooms/units you want to create</label>
                    <input form="addUMultipleUnitForm" type="number" class="form-control" name="no_of_rooms"required>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the initial name of the rooms/units </label>
                    <input form="addUMultipleUnitForm" type="text" class="form-control" name="unit_no" id="unit_no" required>
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">enter the monthly rent of the room/unit</label>
                    <input form="addUMultipleUnitForm" type="number" min="1" class="form-control" name="monthly_rent" required>
                </div>

            </div>
            <div class="modal-footer">
                <button form="addUMultipleUnitForm" type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> create rooms</button>
                </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="notificationToBillTenants" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Watch out for your billing schedule.</h5>


            </div>
            <div class="modal-body">
              It seems like you have not billed the tenants yet for this month. Please click the billings and bill them now.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="notificationToCollectDelinquentAccounts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Watch out for the delinquent accounts.</h5>


            </div>
            <div class="modal-body">
              You have a total of {{ $delinquent_accounts->count() }} delinquent accounts. Please get in touh with them now.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        if(document.getElementById('current_user').value === 'admin' && document.getElementById('count_units').value <= 0){
         $('#addUnit').modal('show');
        }else if(document.getElementById('current_user').value === 'billing' && document.getElementById('posted_bills_this_month_for_rent').value <= 0 ){
            $('#notificationToBillTenants').modal('show');
        }else if(document.getElementById('current_user').value === 'billing' && document.getElementById('delinquent_accounts').value > 0 ){
            $('#notificationToCollectDelinquentAccounts').modal('show');
        }
    });
</script>

<script>
    $(document).ready(() => {
    var url = window.location.href;
    if (url.indexOf("#") > 0){
    var activeTab = url.substring(url.indexOf("#") + 1);
      $('.nav[role="tablist"] a[href="#'+activeTab+'"]').tab('show');
    }

    $('a[role="tab"]').on("click", function() {
      var newUrl;
      const hash = $(this).attr("href");
        newUrl = url.split("#")[0] + hash;
      history.replaceState(null, null, newUrl);
    });
  });
  </script>
{!! $collection_rate->script() !!}
{!! $movein_rate->script() !!}
{!! $moveout_rate->script() !!}
{!! $renewed_chart->script() !!}
@endsection


