@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-dashboard-tab" data-toggle="pill" href="#dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true"><i class="fas fa-tachometer-alt"></i>&nbsp&nbspDashboard</a>
            @if(Auth::user()->user_type === 'admin')
            <a class="nav-link" id="v-pills-units-tab" data-toggle="pill" href="#units" role="tab" aria-controls="v-pills-units" aria-selected="false"> <i class="fas fa-door-closed"></i>&nbsp&nbspUnits</a>
            <a class="nav-link" id="v-pills-investors-tab" data-toggle="pill" href="#investors" role="tab" aria-controls="v-pills-investors" aria-selected="false"><i class="fas fa-user-tie"></i>&nbsp&nbspInvestors</a>
            <a class="nav-link" id="v-pills-tenants-tab" data-toggle="pill" href="#tenants" role="tab" aria-controls="v-pills-tenants" aria-selected="false"><i class="fas fa-user"></i>&nbsp&nbspTenants</a>
            @else
            <a href="/" onclick="return false;" class="nav-link" id="v-pills-units-tab" data-toggle="pill" href="#units" role="tab" aria-controls="v-pills-units" aria-selected="false"> <i class="fas fa-door-closed"></i>&nbsp&nbspUnits</a>
            <a href="/" onclick="return false;" class="nav-link" id="v-pills-investors-tab" data-toggle="pill" href="#investors" role="tab" aria-controls="v-pills-investors" aria-selected="false"><i class="fas fa-user-tie"></i>&nbsp&nbspInvestors</a>
            <a href="/" onclick="return false;" class="nav-link" id="v-pills-tenants-tab" data-toggle="pill" href="#tenants" role="tab" aria-controls="v-pills-tenants" aria-selected="false"><i class="fas fa-user"></i>&nbsp&nbspTenants</a>
            @endif
            @if(Auth::user()->user_type === 'billing')
            <a class="nav-link" id="v-pills-billings-tab" data-toggle="pill" href="#billings" role="tab" aria-controls="v-pills-billings" aria-selected="false"><i class="fas fa-file-invoice-dollar"></i>&nbsp&nbspBillings</a>
            @else
            <a href="/" onclick="return false;"  class="nav-link" id="v-pills-billings-tab" data-toggle="pill" href="#billings" role="tab" aria-controls="v-pills-billings" aria-selected="false"><i class="fas fa-file-invoice-dollar"></i>&nbsp&nbspBillings</a>
            @endif
            @if(Auth::user()->user_type === 'treasury')
            <a class="nav-link" id="v-pills-payments-tab" data-toggle="pill" href="#payments" role="tab" aria-controls="v-pills-payments" aria-selected="false"><i class="fas fa-dollar-sign"></i>&nbsp&nbspPayments</a>
            @else
            <a href="/" onclick="return false;" class="nav-link" id="v-pills-payments-tab" data-toggle="pill" href="#payments" role="tab" aria-controls="v-pills-payments" aria-selected="false"><i class="fas fa-dollar-sign"></i>&nbsp&nbspPayments</a>
            @endif
          </div>
        </div>
        <div class="col-10">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Dashboard</h4>
                        <h5><p class="text-right">{{ Carbon\Carbon::today()->format('M d Y') }}</p></h5>
                        <br>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="card bg-primary">
                                    <div class="card-header">
                                        Occupancy Rate
                                    </div>
                                    <div class="card-body">
                                    <h1 class="text-center">{{ number_format($units->count() == 0 ? 0 :$occupied_units->count()/$units->count() * 100,2) }}%
                                            <span class="text-right"><p><i class="fas fa-chart-line"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div class="card-header">
                                        Units Enrolled
                                    </div>
                                    <div class="card-body">
                                        <h1 class="text-center">{{ $units->count() }}
                                            <span class="text-right"><p><i class="fas fa-home fa-1x"></i></p></span>
                                        </h1>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning">
                                    <div class="card-header">
                                        Investors
                                    </div>
                                    <div class="card-body">
                                        <h1 class="text-center">{{ $investors->count('unit_owner') }}
                                            <span class="text-right"><p><i class="fas fa-user-tie"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success">
                                    <div class="card-header">
                                        Active Tenants
                                    </div>
                                    <div class="card-body">
                                        <h1 class="text-center">{{ $tenants->count() }}
                                            <span class="text-right"><p><i class="fas fa-user"></i></p></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>tenants to watch out</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>name</th>
                                        <th>contact no</th>
                                        <th>unit no</th>   
                                        <th colspan="3"></th>         
                                    </tr>
                                   <?php
                                     $ctr = 1;
                                   ?>   
                                   @foreach($tenants as $item)
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
                                           <?php
                                             $ctr = 1;
                                           ?>   
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
                                                <td><a class="badge badge-success">{{ $item->has_extended }} {{ number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->movein_date)) ) }} days ago</a></td>
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
                                                <th>#</th>
                                                <th>name</th>
                                                <th>status</th>
                                                <th>unit no</th>   
                                                <th></th>          
                                            </tr>
                                           <?php
                                             $ctr = 1;
                                           ?>   
                                           @foreach($recent_movein as $item)
                                            <tr>
                                                <th>{{ $ctr++ }}</th>
                                                <td>
                                                    @if(Auth::user()->user_type === 'admin')
                                                    <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a> <a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @elseif(Auth::user()->user_type === 'treasury')
                                                    <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a><a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @else
                                                    {{ $item->first_name.' '.$item->last_name }}<a class="badge badge-success">{{ $item->has_extended }}</a>
                                                    @endif
                                                </td>
                                                <td>{{ $item->tenant_status }}</td>
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
                                                <th>#</th>
                                                <th>name</th>
                                                <th>unit no</th> 
                                                <th>reason</th>  
                                                <th></th>          
                                            </tr>
                                           <?php
                                             $ctr = 1;
                                           ?>   
                                           @foreach($terminated_contracts as $item)
                                            <tr>
                                                <th>{{ $ctr++ }}</th>
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
                                                <td><a class="badge badge-primary">{{ number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->moveout_date)) ) }} days ago</a></td>
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
                                <h4>delinquents</h4>
                                  
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>name</th>
                                                <th>unit no</th>
                                                <th>balance</th>
                                            </tr>
                                            <?php
                                            $ctr = 1;
                                            ?>   
                                            @foreach ($delinquent_accounts as $item)
                                            
                                            <tr>
                                                <th>{{ $ctr++ }}</th>
                                                <td>
                                                    @if(Auth::user()->user_type === 'admin')
                                                    <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                                    @elseif(Auth::user()->user_type === 'treasury')
                                                    <a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a>
                                                    @elseif(Auth::user()->user_type === 'billing')
                                                    @endif
                                                </td>
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
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-home" aria-selected="true">All <span class="badge badge-light">{{ $units->count() }}</span></a>
                </li>
                @foreach ($units_per_status as $item)
                    <li class="nav-item">
                        <a class="nav-link" id="pills-{{ $item->status }}-tab" data-toggle="pill" href="#{{ $item->status }}" role="tab" aria-controls="pills-{{ $item->status }}" aria-selected="false">{{ $item->status }} <span class="badge badge-light">{{ $item->count }}</span> </a>
                    </li>  
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="#/">|</a>
                </li>
                @foreach ($units_per_building as $item)
                <li class="nav-item">
                    <a class="nav-link" id="pills-{{ $item->building }}-tab" data-toggle="pill" href="#{{ $item->building }}" role="tab" aria-controls="pills-{{ $item->building }}" aria-selected="false">{{ $item->building }} <span class="badge badge-light">{{ $item->count }}</span> </a>
                </li>  
                @endforeach
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
                                                    <font size="-3">{{ $unit->unit_no }} </font>
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

                @foreach ($units_per_building as $item)
                <div class="tab-pane fade" id="{{ $item->building }}" role="tabpanel" aria-labelledby="pills-{{ $item->building }}-tab">
                    <div class="row border-rounded">
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
                @endforeach
              </div>
                    </div>
                </div>   
            </div>

            {{-- display tenants --}}
            <div class="tab-pane fade" id="tenants" role="tabpanel" aria-labelledby="v-pills-tenants-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Tenants ({{ $tenants->count() }})</h4>
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
                                        <th>#</th>
                                        <th>name</th>
                                        <th>unit no</th>
                                        <th>contact no</th>
                                        <th>monthly rent</th>
                                        <th>contract expires in</th>
                                        </tr>
                                    <?php $ctr = 1;?>   
                                    
                                    @foreach ($tenants as $item)
                                    <tr>
                                        <th>{{ $ctr++ }}</th>
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
                        <h4>Investors ({{ $investors->count() }})</h4>
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
                                        <th>#</th>
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
                                        <th>{{ $ctr++ }}</th>
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

            {{-- display billings --}}
            <div class="tab-pane fade" id="billings" role="tabpanel" aria-labelledby="v-pills-billings-tab">
                <div class="card">
                    <div class="card-body">
                        
                       <h4> Billings </h4>  
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
                                                <th>#</th>
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
                                                <th>{{ $ctr++ }}</th>
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
                                <th>#</th>
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
                                <th>{{ $ctr++ }}</th>
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
                        <h4>payments </h4>
                        <p class="text-right">
                            <a class="btn btn-primary" href="/tenants/search"><i class="fas fa-plus"></i> payment</a>
                            <a class="btn btn-primary" href="/payments/all"><i class="fas fa-search-dollar"></i> show more payments</a>
                        </p>
                        
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
          </div>
        </div>
      </div>
</div>
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
 

