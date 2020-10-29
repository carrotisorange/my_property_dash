@extends('templates.webapp-new.template')

@section('title', $tenant->first_name.' '.$tenant->last_name)

@section('sidebar')
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          {{-- <img src="{{ asset('/argon/assets/img/brand/logo.png') }}" class="navbar-brand-img" alt="...">--}}{{ $property->name }} 
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/dashboard">
                <i class="fas fa-tachometer-alt text-orange"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/home">
                <i class="fas fa-home text-indigo"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/calendar">
                <i class="fas fa-calendar-alt text-red"></i>
                <span class="nav-link-text">Calendar</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
            <li class="nav-item">
              <a class="nav-link active" href="/property/{{$property->property_id }}/tenants">
                <i class="fas fa-user text-green"></i>
                <span class="nav-link-text">Tenants</span>
              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/owners">
                <i class="fas fa-user-tie text-teal"></i>
                <span class="nav-link-text">Owners</span>
              </a>
            </li>
            @endif

            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/concerns">
                <i class="fas fa-tools text-cyan"></i>
                <span class="nav-link-text">Concerns</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/joborders">
                <i class="fas fa-list text-dark"></i>
                <span class="nav-link-text">Job Orders</span>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/personnels">
                <i class="fas fa-user-secret text-gray"></i>
                <span class="nav-link-text">Personnels</span>
              </a>
            </li>
            @endif

            @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/bills">
                <i class="fas fa-file-invoice-dollar text-pink"></i>
                <span class="nav-link-text">Bills</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/collections">
                <i class="fas fa-coins text-yellow"></i>
                <span class="nav-link-text">Collections</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/financials">
                <i class="fas fa-chart-line text-purple"></i>
                <span class="nav-link-text">Financials</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'ap' || Auth::user()->user_type === 'admin')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/payables">
                <i class="fas fa-file-export text-indigo"></i>
                <span class="nav-link-text">Payables</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/users">
                <i class="fas fa-user-circle text-green"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Documentation</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
                   <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/getting-started" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/system-updates" target="_blank">
                <i class="fas fa-bug text-red"></i>
                <span class="nav-link-text">System Updates</span>
              </a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/announcements" target="_blank">
                <i class="fas fa-microphone text-purple"></i>
                <span class="nav-link-text">Annoncements</span>
              </a>
            </li>
             {{--  <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                <i class="ni ni-chart-pie-35"></i>
                <span class="nav-link-text">Plugins</span>
              </a>
            </li> --}}
            
          </ul>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('upper-content')
<?php   $diffInDays =  number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($tenant->moveout_date), false)) ?>
<div class="row align-items-center py-4">
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-dark d-inline-block mb-0">{{ $tenant->first_name.' '.$tenant->last_name }}</h6>
    
  </div>

</div>
<div class="row">
  <div class="col-md-12">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @if($tenant->email_address === null || $tenant->contact_no === null)
        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="nav-profile" aria-selected="true"><i class="fas fa-user fa-sm text-primary-50"></i> Profile <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i></span></a>
        @else
        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="nav-profile" aria-selected="true"><i class="fas fa-user fa-sm text-primary-50"></i> Profile</a>
        @endif

        @if($access->count() <=0  )
        <a class="nav-item nav-link" id="nav-user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="nav-user" aria-selected="true"><i class="fas fa-user-lock fa-sm text-primary-50"></i> Access <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i></span>  </a>
        @else
        <a class="nav-item nav-link" id="nav-user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="nav-user" aria-selected="true"><i class="fas fa-user-lock fa-sm text-primary-50"></i> Access </a>
        @endif
       
        @if($diffInDays <= 30)
        <a class="nav-item nav-link" id="nav-contracts-tab" data-toggle="tab" href="#contracts" role="tab" aria-controls="nav-contracts" aria-selected="false"><i class="fas fa-file-signature fa-sm text-primary-50"></i> Contracts <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i></span></a>
         @else
         <a class="nav-item nav-link" id="nav-contracts-tab" data-toggle="tab" href="#contracts" role="tab" aria-controls="nav-contracts" aria-selected="false"><i class="fas fa-file-signature fa-sm text-primary-50"></i> Contracts</a>
         @endif 

         @if($balance->count() <= 0)
         <a class="nav-item nav-link" id="nav-bills-tab" data-toggle="tab" href="#bills" role="tab" aria-controls="nav-bills" aria-selected="true"><i class="fas fa-file-invoice-dollar fa-sm text-primary-50"></i> Bills </a>
         @else
         <a class="nav-item nav-link" id="nav-bills-tab" data-toggle="tab" href="#bills" role="tab" aria-controls="nav-bills" aria-selected="true"><i class="fas fa-file-invoice-dollar fa-sm text-primary-50"></i> Bills <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i> {{ $balance->count() }}</span></a>
         @endif

         
         <a class="nav-item nav-link" id="nav-payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="nav-payments" aria-selected="true"><i class="fas fa-money-bill fa-sm text-primary-50"></i> Payments <span class="badge badge-primary badge-counter">{{ $collections_count }}</span></a>


        <a class="nav-item nav-link" id="nav-concerns-tab" data-toggle="tab" href="#concerns" role="tab" aria-controls="nav-concern" aria-selected="false"><i class="fas fa-tools fa-sm text-primary-50"></i> Concerns</a>
      </div>
    </nav>
    
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        
<div class="row">
  <div class="col-md-8">
    <a href="/property/{{ $property->property_id }}/home/{{ $unit->unit_id }}"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-home fa-sm text-white-50"></i> Home</a>
    @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin')
    <a href="/property/{{ $property->property_id }}/home/{{ $tenant->unit_tenant_id }}/tenant/{{ $tenant->tenant_id }}/edit"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-edit fa-sm text-white-50"></i> Edit</a>  
    @endif

     <br><br>
     @if($tenant->email_address === null || $tenant->contact_no === null)
    <p class="text-danger">Email address or mobile is missing!</p>
     @endif
      <div class="table-responsive text-nowrap">
        <table class="table" >

                 {{-- <input type="hidden" value="{{ ($tenant->updated_at) }}" id="approve_moveout_at">  --}}
            
              <tr>
                  <td>Tenant</td>
                  <td>{{ $tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name }} 
                      @if($tenant->tenant_status === 'active')
                          <span class="badge badge-success">{{ $tenant->tenant_status }}</span>
                      @elseif($tenant->tenant_status === 'pending')
                          <span class="badge badge-warning">{{ $tenant->tenant_status }}</span>
                      @else
                          <span class="badge badge-danger">{{ $tenant->tenant_status }}</span>
                      @endif
                  </td>
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
                <td>Guardian</td>
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
  </div>
  <div class="col-md-4">
  
    <img  src="{{ $tenant->tenant_img? asset('/storage/tenants/'.$tenant->tenant_img): asset('/arsha/assets/img/no-image.png') }}" alt="..." class="img-thumbnail">
   
    <form id="uploadImageForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/edit/img" method="POST" enctype="multipart/form-data">
      @method('put')
      @csrf
    </form>
  <br>

    <input type="file" form="uploadImageForm" name="tenant_img" class="form-control @error('tenant_img') is-invalid @enderror">
    @error('tenant_img')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
  @enderror
    <br>
   
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-user btn-block" form="uploadImageForm"><i class="fas fa-upload fa-sm text-white-50"></i> Upload Image </button>

  </div>

</div>
      </div>
      <div class="tab-pane fade" id="concerns" role="tabpanel" aria-labelledby="nav-concerns-tab">
        <a  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addConcern" data-whatever="@mdo"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>  
        <br><br>
        <div class="row" >
          <div class="col-md-12 mx-auto" >
        <div class="table-responsive text-nowrap">
         <table class="table">
           <?php $ctr = 1; ?>
           <thead>
             <tr>
               <th>#</th>
               
                 <th>Date Reported</th>
                
                 <th>Room</th>
                 <th>Type</th>
                 <th>Description</th>
                 <th>Urgency</th>
                 <th>Status</th>
                 <th>Assigned to</th>
                 <th>Rating</th>
                 <th>Feedback</th>
            </tr>
           </thead>
           <tbody>
             @foreach ($concerns as $item)
             <tr>
               <th>{{ $ctr++ }}</th>
            
               <td>{{ Carbon\Carbon::parse($item->date_reported)->format('M d Y') }}</td>
                 
                 <td>{{ $item->building.' '.$item->unit_no }}</td>
                 <td>
                   
                     {{ $item->concern_type }}
                     
                 </td>
                 <td ><a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}/tenant/{{ $item->tenant_id }}/concern/{{ $item->concern_id }}">{{ $item->concern_item }}</a></td>
                 <td>
                     @if($item->concern_urgency === 'urgent')
                     <span class="badge badge-danger">{{ $item->concern_urgency }}</span>
                     @elseif($item->concern_urgency === 'major')
                     <span class="badge badge-warning">{{ $item->concern_urgency }}</span>
                     @else
                     <span class="badge badge-primary">{{ $item->concern_urgency }}</span>
                     @endif
                 </td>
                 <td>
                     @if($item->concern_status === 'pending')
                     <span class="badge badge-warning">{{ $item->concern_status }}</span>
                     @elseif($item->concern_status === 'active')
                     <span class="badge badge-primary">{{ $item->concern_status }}</span>
                     @else
                     <span class="badge badge-success">{{ $item->concern_status }}</span>
                     @endif
                 </td>
                 <td>{{ $item->name }}</td>
                 <td>{{ $item->rating? $item->rating.'/5' : 'NA' }}</td>
                 <td>{{ $item->feedback? $item->feedback : 'NULL' }}</td>
             </tr>
             @endforeach
           </tbody>
         </table>
        
       </div>
                
                
          </div>
      </div>
      </div>
      <div class="tab-pane fade" id="contracts" role="tabpanel" aria-labelledby="nav-contracts-tab">
      
        @if($diffInDays <= 30 )
        <span  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#sendNotice" data-whatever="@mdo"><i class="fas fa-paper-plane fa-sm text-white-50"></i> Send Notice</span> 
        @endif

        @if ($tenant->tenant_status === 'inactive'|| $balance->sum('balance') <= 0) 
        <span  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#extendTenant" data-whatever="@mdo"><i class="fas fa-external-link-alt fa-sm text-white-50"></i> Extend</span>
        @else
        <span  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#moveoutTenantWarning" data-whatever="@mdo"><i class="fas fa-external-link-alt fa-sm text-white-50"></i> Extend</span>
        @endif
       
        
   
    @if ($tenant->tenant_status === 'active' || $tenant->tenant_status === 'pending')
       
          @if($tenant->created_at == null && $tenant->updated_at == null)
          <span href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#requestToMoveoutModal" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Terminate</span>
          @elseif($tenant->created_at == null && $tenant->updated_at != null)
            @if(Auth::user()->user_type === 'manager')
            <span href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#approveToMoveoutModal" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Terminate</span>
            @else
              <button title="Waiting for the manager to approve..." class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" ><i class="fas fa-clock fa-sm text-white-50"></i> Pending Moveout</button>
            @endif
          @elseif($tenant->created_at != null && $tenant->updated_at != null)
          @if($balance->sum('balance') > 0)
          <span href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#moveoutTenantWarning" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Moveout</span>
          @else
          <button  href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#moveoutTenant" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Moveout</button>
          @endif
      @endif

    @endif
    
        <div class="row">
          
          <div class="col-md-12 mx-auto">
     
    <br>
    @if($diffInDays <= 30)
    <p class="text-danger">Contract expires in {{ $diffInDays }} days!</p>
    @endif
            <div class="table-responsive text-nowrap">
              <table class="table">
                <tr>
                  <td>Room</td>
                  <td><a href="/property/{{ $property->property_id }}/home/{{ $unit->unit_id }}">{{ $unit->building.' '.$unit->unit_no }}</a></td>
              </tr>
              <tr>
                  <td>Monthly Rent</td>
                  <td>{{ number_format($tenant->tenant_monthly_rent, 2) }}</td>
              </tr>
              <?php 
                  $renewal_history = explode(",", $tenant->renewal_history); 
                  
              ?>
              <tr>
                  <td>Current Contract Period</td>
                  <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }} 
                    @if( $tenant->has_extended === 'renewed')
                    <span class="badge badge-success">{{ $tenant->has_extended}} 
                     
                     ({{ count($renewal_history)-1 }}x) 
                   </span>  
                    @endif
                   @if($tenant->tenant_status === 'pending')
                   @else
                      @if($diffInDays <= -1)
                      <span class="badge badge-danger">contract has lapsed {{ $diffInDays*-1 }} days ago</span> 
                      @else
                      <span class="badge badge-warning">contract expires in {{ $diffInDays }} days </span>
                      @endif
                   @endif
                  </td>
              </tr>
              
                  <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>
                  @for ($i = 1; $i < count($renewal_history); $i++)
                  <tr>
                   <td>{{$numberFormatter->format($i) }} contract</td>
                  <td> 
                      {{ $renewal_history[$i] }}<br>         
                  </td>
              </tr>
              @endfor  
               @if($tenant->tenant_status === 'inactive')
              <tr>
                <td>Actual Moveout Date</td>
                <td>
                    {{ Carbon\Carbon::parse($tenant->actual_move_out_date)->format('M d Y') }}
                </td>
              </tr>
              @endif 
              @if($tenant->tenants_note !== 'new' )
              <tr>
                  <td>Note</td>
                  <td>
                      {{ $tenant->tenants_note }}
                  </td>
              </tr>
              @endif
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="nav-user-tab">
        @if($access->count() <=0  )
        <button  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#userAccess" data-whatever="@mdo"><i class="fas fa-user-lock fa-sm text-white-50"></i> Create user access</button>
        <br><br>
        @endif
     
        
        <div class="col-md-12 mx-auto">
          <div class="table-responsive">
            <div class="table-responsive text-nowrap">
             @if($access->count() <= 0)
              <p class="text-center text-danger">No credentials found!</p>

             @else
             @foreach ($access as $item)
              
             <table class="table">
               
                 <tr>  
                   <th>Name</th>
                   <td>{{ $item->name }}</td>
                 </tr>
               
                 <tr>
                   <th>Email</th>
                   <td>{{ $item->email }}</td>
                 </tr>
               
                 <tr>
                  <th>Created at</th>
                  <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                </tr>

                <tr>
                  <th>Updated at</th>
                  <td>{{ Carbon\Carbon::parse($item->updated_at)->format('M d Y') }}</td>
                </tr>
             </table>
             @endforeach


             @endif
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="bills" role="tabpanel" aria-labelledby="nav-bills-tab">
        <a href="#" data-toggle="modal" data-target="#addBill" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a> 
        @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
          <a href="/property/{{ $property->property_id }}/home/{{ $tenant->unit_tenant_id }}/tenant/{{ $tenant->tenant_id }}/bills/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
          @endif
          @if($balance->count() > 0)
          <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/download" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export</span></a>
          @if($tenant->email_address !== null)
          <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/send" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-paper-plane  fa-sm text-white-50"></i> Send</span></a>
          @endif
          @endif
        
      

    <br>
    <br>
    <div class="col-md-12 mx-auto">
    <div class="table-responsive">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <?php $ctr=1; ?>
          <tr>
         <th class="text-center">#</th>
          <th>Date Billed</th>
            <th>Bill No</th>
            
            <th>Description</th>
            <th>Period Covered</th>
            <th class="text-right" colspan="3">Amount</th>
            
          </tr>
          @foreach ($balance as $item)
          <tr>
         <th class="text-center">{{ $ctr++ }}</th>
            <td>
              {{Carbon\Carbon::parse($item->billing_date)->format('M d Y')}}
            </td>   

              <td>{{ $item->billing_no }}</td>
      
              <td>{{ $item->billing_desc }}</td>
              <td>
                {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
              </td>
              <td class="text-right" colspan="3">{{ number_format($item->balance,2) }}</td>
                     </tr>
          @endforeach
    
      </table>
      <table class="table">
        <tr>
         <th>Total</th>
         <th class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
        </tr>
        @if($tenant->tenant_status === 'pending')
  
        @else
         <tr>
          <th class="text-danger">Total After Due Date(+10%)</th>
          <th class="text-right text-danger">{{ number_format($balance->sum('balance') + ($balance->sum('balance') * .1) ,2) }}</th>
         </tr> 
        @endif
        
      </table>
    </div>
    </div>
    
      </div>
      <small>Message Footer</small>
      <p>
        {!! Auth::user()->note !!}
      </p> 
        <br>
      </div>
      <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="nav-payments-tab">
        @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
        <a href="#" data-toggle="modal" data-target="#acceptPayment" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>
        @endif 
        <br><br>
        <div class="col-md-12 mx-auto">
        <div class="table-responsive text-nowrap">
          <table class="table">
              @foreach ($collections as $day => $collection_list)
                <tr>
                    <th colspan="10">{{ Carbon\Carbon::parse($day)->addDay()->format('M d Y') }} ({{ $collection_list->count() }})</th>
                    
                </tr>
                <tr>
                  <?php $ctr = 1; ?>
                    <th class="text-center">#</th>
                    <th>AR No</th>
                    <th>Bill No</th>
                    <th>Room</th>  
                    <th>Description</th>
                    <th colspan="2">Period Covered</th>
                    <th>Form of Payment</th>
                    <th class="text-right">Amount</th>
                   
                    <th colspan="2" class="text-center">Action</th>
                    </tr>
              </tr>
                @foreach ($collection_list as $item)
               
                <tr>
                      <th class="text-center">{{ $ctr++ }}</th>
                        <td>{{ $item->ar_no }}</td>
                        <td>{{ $item->payment_billing_no }}</td>
                          <td>{{ $item->building.' '.$item->unit_no }}</td> 
                         <td>{{ $item->billing_desc }}</td> 
                         <td colspan="2">
                          {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                          {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                        </td>
                        <td>{{ $item->form_of_payment }}</td>
                        <td class="text-right">{{ number_format($item->amt_paid,2) }}</td>
                        
                        <td class="text-center">
                          <a title="export" target="_blank" href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/payments/{{ $item->payment_id }}/dates/{{$item->payment_created}}/export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i></a>
                          {{-- <a target="_blank" href="#" title="print invoice" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print fa-sm text-white-50"></i></a> 
                          --}}
                        </td>
                        <td class="text-center">
                          @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
                          <form action="/tenants/{{ $item->tenant_id }}/payments/{{ $item->payment_id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button title="delete" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                          </form>
                          @endif
                        </td>   
                       
                    </tr>
                @endforeach
                    <tr>
                      <th>Total</th>
                      <th colspan="8" class="text-right">{{ number_format($collection_list->sum('amt_paid'),2) }}</th>
                    </tr>
                    
              @endforeach
          </table>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>




                {{-- Modal for renewing tenant --}}
                <div class="modal fade" id="addConcern" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Concern</h5>
              
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                          <form id="concernForm" action="/property/{{ $property->property_id }}/tenant/{{ $tenant->tenant_id }}/concern" method="POST">
                              {{ csrf_field() }}
                          </form>

                          <input type="hidden" form="concernForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}"required>
                          <input type="hidden" form="concernForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}"required>

                          <div class="row">
                            <div class="col">
                                <label>Date Reported</label>
                                <input type="date" form="concernForm" class="form-control" name="date_reported" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required >
                            </div>
                        </div>
                        <br>
                          <div class="row">
                              <div class="col">
                                 <label>Type</label>
                                  <select class="form-control" form="concernForm" name="concern_type" id="" required>
                                    <option value="" selected>Please select one</option>
                                    <option value="billing">billing</option>
                                    <option value="employee">employee</option>
                                    <option value="internet">internet</option>
                                    <option value="neighbour">neighbour</option>
                                    <option value="noise">noise</option>
                                    <option value="odours">odours</option>
                                    <option value="parking">parking</option>
                                    <option value="pets">pets</option>
                                    <option value="repair">repair</option>
                                    <option value="others">others</option>
                                  </select>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col">
                               <label>Urgency</label>
                                <select class="form-control" form="concernForm" name="concern_urgency" id="" required>
                                  <option value="" selected>Please select one</option>
                                  <option value="minor and not urgent">minor and not urgent</option>
                                  <option value="minor but urgent">minor but urgent</option>
                                  <option value="major but not urgent">major but not urgent</option>
                                  <option value="major and urgent">major and urgent</option>
                                </select>
                            </div>
                        </div>
                        <br>
                       
                      <div class="row">
                        <div class="col">
                            <label>Short Description</label>
                          
                            <input type="text" form="concernForm" class="form-control" name="concern_item" required >
                        </div>
                      </div>  
                      <br>
                      
                       <div class="row">
                            <div class="col">
                                <label>Details</label>
                                
                                <textarea form="concernForm" rows="7" class="form-control" name="concern_desc" required></textarea>
                            </div>
                        </div>
                        <br>
                       <div class="row">
                          <div class="col">
                              <label for="movein_date">Assign concern to</label>
                              <select class="form-control" form="concernForm" name="concern_user_id" required>
                                <option value="" selected>Please select one</option>
                                @foreach($users as $item)
                                <option value="{{ $item->id }}"> {{ $item->user_type }}</option>
                                @endforeach
                               
                              </select>
                          </div>
                      </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> 
                          <button type="submit" form="concernForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
                      </div>
                  </div>
                  </div>
              </div>


        {{-- Modal to moveout tenant --}}
        <div class="modal fade" id="moveoutTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Moveout</h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="moveoutTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/moveout" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                    </form>
                    <input type="hidden" form="moveoutTenantForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}" required>
                    <input type="hidden" form="moveoutTenantForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}" required>
                    <div class=" row">
                        <div class="col">
                          <p class="text-center">{{ $tenant->first_name.' '.$tenant->last_name }} is ready to moveout in {{ $unit->building.' '.$unit->unit_no }} on {{ Carbon\Carbon::parse($tenant->actual_move_out_date)->format('M d Y') }}. </p>
                          
                        </div>
                    </div>
                  
                  <div class="modal-footer">
                    <button form="moveoutTenantForm" type="submit" class="btn btn-primary btn-user btn-block"  onclick="this.form.submit(); this.disabled = true;">
                      Print Gatepass
                   </button>
                  
                </div>
             
            </div>
            </div>
        </div>
        </div>
        
        {{-- Modal for renewing tenant --}}
        <div class="modal fade" id="extendTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Extend</h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="extendTenantForm" action="/property/{{ $property->property_id }}/home/{{ $unit->unit_id }}/tenant/{{ $tenant->tenant_id }}/extend" method="POST">
                        @csrf
                    </form>
        
                    <div class="row">
                        <div class="col-md-8">
                            <label for="movein_date">New Move in Date</label>
                            <input class='form-control' type="date" form="extendTenantForm" class="" name="movein_date" value="{{ $tenant->moveout_date }}" required>
                            <input type="hidden" form="extendTenantForm" class="" name="action" value="extend_contract" required>
                            {{-- <input type="text" form="" class="form-control" name="" value="{{ Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }}" required readonly> --}}
                        </div>

                        <div class="col-md-4">
                          <label for="moveout_date">Extend Contract To</label>
                          <input class='form-control' type="number" form="extendTenantForm" min="1" class="" name="no_of_months" min="1" placeholder="enter the number of months" required >
                          <input type="hidden" form="extendTenantForm" class="form-control" name="old_movein_date" value="{{ $tenant->movein_date }}" required>
                      </div>
                    </div>
                    <br>
                
                    
                    <div class="row">
                        <div class="col"> 
                               <p class="">
                                <span id='remove_charges' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove</span>
                                <span id="add_charges" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</span>     
                               </p>
                            
                            
                                <table class ="table table-bordered" id="extend_table">
                                    <tr>
                                        <th>Bill No</th>
                                        <th>Description</th>
                                        <th colspan="2">Period Covered</th>
                                        <th>Amount</th>
                                    </tr>
                                        <input form="extendTenantForm" type="hidden" id="no_of_items" name="no_of_items" >
                                    
                                    <tr id='row1'></tr>
                                </table>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> --}}
                    <button form="extendTenantForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
                </div>
            </div>
            </div>
        </div>
        
        {{-- Modal for warning message --}}
        <div class="modal fade" id="moveoutTenantWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pending Balance </h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

               
                <div class="modal-body">
                  <div class="row">
                    <div class="col">
  
                      <div class="table-responsive text-nowrap">
                       
                        <table class="table">
                          <tr>
                          {{-- <td></td> --}}
                            <th>Bill No</th>
                           
                            <th>Description</th>
                            <th>Period Covered</th>
                            <th class="text-right" colspan="3">Amount</th>
                            
                          </tr>
                          @foreach ($balance as $item)
                          <tr>
                            {{-- <td>
                              <form action="/billings/{{ $item->billing_id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                              </form>
                            </td>    --}}
                              <td>{{ $item->billing_no }}</td>
                      
                              <td>{{ $item->billing_desc }}</td>
                              <td>
                                {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                                {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                              </td>
                              <td class="text-right" colspan="3">{{ number_format($item->balance,2) }}</td>
                          </tr>
                         
                          @endforeach
                          <tr>
                            <th colspan="4">Total</th>
                            <th class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
                          </tr>
                    
                      </table>
                     
                    </div>
                    </div>
                    
                  </div>
                 
               </div>
               <div class="modal-footer">
                 <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
                
             </div>
             
                
              
            </div>
            </div>
        
        </div>

                {{-- Modal for requesting to moveout --}}
                <div class="modal fade" id="requestToMoveoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Terminate </h5>
              
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
  
                      <div class="modal-body">
                      <form id="requestMoveoutForm" action="/property/{{ $property->property_id }}/home/{{ $tenant->unit_tenant_id }}/tenant/{{ $tenant->tenant_id }}/request" method="POST">
                        @method('put')
                         @csrf
                        </form>
                        <input form="requestMoveoutForm" type="hidden" name="action" value="request to moveout">
                        <input type="hidden" form="requestMoveoutForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}"required>
                        <input type="hidden" form="requestMoveoutForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}"required>
                        <div class=" row">
                          <div class="col-md-8">
                              <small>Moveout Date</small>
                              <input class='form-control col-md-6' type="date" form="requestMoveoutForm" name="actual_move_out_date" id="actual_moveout_date" value="{{ $tenant->moveout_date }}" required>
                          </div>

                          <div class="col-md-4">
                            <small>Select Reason of Moveout</small>
                              <select class='form-control' form="requestMoveoutForm" name="reason_for_moving_out" id="reason_for_moving_out" required>
                                  <option value="">Please select one</option>
                                  <option value="end of contract">end of contract</option>
                                  <option value="delinquent">delinquent</option>
                                  <option value="force majeure">force majeure</option>
                                  <option value="run away">run away</option>
                                  <option value="unruly">unruly</option>
                              </select>
                          </div>
                      </div>
                      <br>
                      @if($balance->count() > 1 )
           
                  

                      <div class="row">
                        <div class="col">
                          <small>Pending balance</small>
                          <div class="table-responsive text-nowrap">
                           
                            <table class="table table-bordered">
                              <tr>
                            
                                <th>Bill No</th>
                               
                                <th>Description</th>
                                <th>Period Covered</th>
                                <th class="text-right" colspan="3">Amount</th>
                                
                              </tr>
                              @foreach ($balance as $item)
                              <tr>
                              
                                  <td>{{ $item->billing_no }}</td>
                          
                                  <td>{{ $item->billing_desc }}</td>
                                  <td>
                                    {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                                    {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                                  </td>
                                  <td class="text-right" colspan="3">{{ number_format($item->balance,2) }}</td>
                                         </tr>
                              @endforeach
                        
                          </table>
                          <table class="table">
                            <tr>
                             <th>TOTAL AMOUNT PAYABLE</th>
                             <th class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
                            </tr>    
                          </table>
                        </div>
                        </div>
                        
                      </div>
                      <hr>
                      @endif
                      <div class="row">
                        <div class="col">

                          <p class="">
                            <span id='delete_row' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Bill</span>
                          <span id="add_row" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Bill </span>     
                          </p>
                            <div class="table-responsive text-nowrap">
                            <table class = "table table-bordered" id="tab_logic">
                                <tr>
                                    <th>Bill No</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    
                                </tr>
                                    <input form="requestMoveoutForm" type="hidden" id="no_of_charges" name="no_of_charges" >
                                <tr id='addr1'></tr>
                            </table>
                          </div>
                        </div>
                      </div>
                        <br>
                        
                       
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
                      
                        <button type="submit" form="requestMoveoutForm" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i>  Terminate</button>
                     
                   </div>
                     
                
                  </div>
                  </div>
              
              </div>

              {{-- Modal to approve to moveout --}}
              <div class="modal fade" id="approveToMoveoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Moveout </h5>
            
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    <div class="modal-body">
                      <form id="approveMoveoutForm" action="/property/{{ $property->property_id }}/home/{{ $tenant->unit_tenant_id }}/tenant/{{ $tenant->tenant_id }}/approve" method="POST">
                        @method('put')
                         {{ csrf_field() }}
                        <input form ="approveMoveoutForm" type="hidden" name="action" value="approve to moveout">
                      </form>
                      <div class="row">
                        <div class="col">
                          <small>Actual Moveout Date</small>
                          <input class="form-control" type="date" name="actual_move_out_date" value={{ $tenant->actual_move_out_date }}>
                    
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <small>Reason for Moving Out</small>
                          <select form="approveMoveoutForm" class="form-control" name="reason_for_moving_out" id="reason_for_moving_out" required>
                            <option value="{{ $tenant->reason_for_moving_out }}">{{ $tenant->reason_for_moving_out }}</option>
                            <option value="end of contract">end of contract</option>
                            <option value="delinquent">delinquent</option>
                            <option value="force majeure">force majeure</option>
                            <option value="run away">run away</option>
                            <option value="unruly">unruly</option>
                        </select>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col">
                          <small>Pending balance</small>
                          <div class="table-responsive text-nowrap">
                           
                            <table class="table">
                              <tr>
                           
                                <th>Bill No</th>
                               
                                <th>Description</th>
                                <th>Period Covered</th>
                                <th class="text-right" colspan="3">Amount</th>
                                <th>Action</th>
                              </tr>
                              @foreach ($balance as $item)
                              <tr>
                                
                                  <td>{{ $item->billing_no }}</td>
                          
                                  <td>{{ $item->billing_desc }}</td>
                                  <td>
                                    {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                                    {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                                  </td>
                                  <td class="text-right" colspan="3">{{ number_format($item->balance,2) }}</td>
                                  <td>
                                    <form action="/billings/{{ $item->billing_id }}" method="POST">
                                      @csrf
                                      @method('delete')
                                      <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-trash fa-sm text-white-50"></i></button>
                                    </form>
                                  </td>   
                                         </tr>
                              @endforeach
                              <tr>
                                <th>Total</th>
                                <th class="text-right" colspan="3">{{ number_format($balance->sum('balance'),2) }} </th>
                               </tr>  
                          </table>
                        
                        </div>
                        </div>
                        
                      </div>
                      
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                      <button form="approveMoveoutForm" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Approve Moveout</button>
                  
                 </div>
                   
              
                </div>
                </div>
            
            </div>

            {{-- add/edit image of the tenant --}}
                    {{-- Modal for warning message --}}
        <div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Image </h5>
      
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>

             
              <div class="modal-body">
               
               
             </div>
             <div class="modal-footer">
         
               <button title="balance has to be settled before moving out." href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{  $tenant->tenant_id }}/billings" form="extendTenantForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check fa-sm text-white-50"></i> Upload</button> 
            
           </div>
           
              
            
          </div>
          </div>
      
      </div>

      <div class="modal fade" id="addBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Bill</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
         <div class="modal-body">
          <form id="addBillForm" action="/billings/" method="POST">
             @csrf
          </form>
         
          <input type="hidden" form="addBillForm" name="action" value="add_move_in_charges" required>
          <input type="hidden" form="addBillForm" name="tenant_id" value="{{ $tenant->tenant_id }}" required>
          <input type="hidden" form="addBillForm" name="property_id" value="{{ $property->property_id }}" required>
          
          <div class="row">
            <div class="col">
                <small>Billing Date</small>
                {{-- <input type="date" form="addBillForm" class="form-control" name="billing_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required > --}}
                <input type="date" class="form-control" form="addBillForm" class="" name="billing_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required >
            </div>
          </div>
         
          <br>
          <div class="row">
            <div class="col">
           
              <p class="text-left">
                <span id='delete_bill' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove</span>
              <span id="add_bill" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</span>     
              </p>
                <div class="table-responsive text-nowrap">
                <table class = "table table-bordered" id="table_bill">
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th colspan="2">Period Covered</th>
                        <th>Amount</th>
                        
                    </tr>
                        <input form="addBillForm" type="hidden" id="no_of_bills" name="no_of_bills" >
                    <tr id='bill1'></tr>
                </table>
              </div>
            </div>
          </div>
         
        </div>
        <div class="modal-footer">
         <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel </button>
         <button form="addBillForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
        </div> 
        </div>
        </div>
        
        </div>
{{-- modal for adding payments. --}}

<div class="modal fade" id="acceptPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
      
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="acceptPaymentForm" action="/property/{{ $property->property_id }}/tenant/{{ $tenant->tenant_id }}/collection" method="POST">
          @csrf
          </form>
          
          <div class="row">
              <div class="col">
                  <small for="">Date</small>
              {{-- <input form="acceptPaymentForm" type="date" class="form-control" name="payment_created" value={{date('Y-m-d')}} required> --}}
              <input  class='form-control' type="date" form="acceptPaymentForm" class="" name="payment_created" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required >
              </div>
              
                {{-- <small for="">Acknowledgment Receipt No</small> --}}
                <input class='form-control' form="acceptPaymentForm" type="hidden" class="" id="" name="ar_no" value="{{ $payment_ctr }}" required readonly>
            
          </div>
        
  <br>
          <div class="row">
            <div class="col-md-12">
           
              <p class="text-left">
                <a href="#/" id='delete_payment' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Bill</a>
              <a href="#/" id="add_payment" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i> Bill</a>     
              </p>
                <div class="table-responsive text-nowrap">
                <table class = "table table-bordered" id="payment">
                    <tr>
                        <th>#</th>
                        <th>Bill</th>
                        <th>Amount</th>
                        <th>Form of Payment</th>
                        <th>Bank Name</th>
                        <th>Cheque No</th>
                    </tr>
                        <input form="acceptPaymentForm" type="hidden" id="no_of_payments" name="no_of_payments" >
                    <tr id='payment1'></tr>
                </table>
              </div>
            </div>
          </div>        
       
          <input type="hidden" form="acceptPaymentForm" id="payment_tenant_id" name="payment_tenant_id" value="{{ $tenant->tenant_id }}">
          <input type="hidden" form="acceptPaymentForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}">
          <input type="hidden" form="acceptPaymentForm" id="tenant_status" name="tenant_status" value="{{ $tenant->tenant_status }}">
        
      </div>
      <div class="modal-footer">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
          <button form="acceptPaymentForm" id ="addPaymentButton" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50f"></i> Submit</button>
      </div>
  
  </div>
  </div>
  
  
  </div>

         {{-- Modal for warning message --}}
         <div class="modal fade" id="sendNotice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Send Notice</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <span class="text-justify">
                      <h5>Hello, {{ $tenant->first_name }}!</h5>
                  
                      <p>Your contract in <b>{{ $unit->building.' '.$unit->unit_no }}</b> is set to expire on <b>{{ Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }}</b>, exactly <b>{{ $diffInDays }} days </b> from now. 
                          
                      Would you like to extend your contract?If yes, for how long? </p>
                  
                      <p><b>This is a system generated message, and we do not receive emails from this account. Please let us know your response atleast a week before your moveout date through this email {{ Auth::user()->email }} instead. </b></p>
                  
                      Sincerely,
                      <br>
                      {{ Auth::user()->property }}
                    </span>
                    <hr>
                  
                    <form action="/units/{{ $unit->unit_id }}/tenants/{{ $tenant->tenant_id }}/alert/contract">
                      @csrf
                    <span>
                      <p class="text-right">
                      <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
                      <button class="btn btn-primary d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" title="for manager and admin access only" type="submit" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-paper-plane fa-sm text-white-50"></i> Send</button>
                      </p>
                    </form>
                  </p>
              </div>
              
          </div>
          </div>
</div>

<div class="modal fade" id="userAccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-user-lock"></i> Tenant Credentials</h5>
  
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
   <div class="modal-body">
     <p class="text-danger"><i class="fas fa-exclamation-triangle"></i>  Tenant needs to verify email before can access the system. 
      <br> Please make sure that the email is valid before creating credentials. </p>
      
     <form id="userForm" action="/tenant/{{ $tenant->tenant_id }}/user/create" method="POST">
    @csrf
    </form>
     <table class="table table-borderless">
      <tr>
        <th>Name</th>
        <td><input type="text" name="name" form="userForm" class="form-control form-control-user @error('name') is-invalid @enderror" value="{{ $tenant->first_name.' '.$tenant->last_name }}" required>
        <br>
        @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      </td>
      
      </tr>
       <tr>
         <th>Email</th>
         <td><input type="email" name="email" form="userForm"  class="form-control form-control-user @error('email') is-invalid @enderror" value="{{ $tenant->email_address }}" required>
        <br>
        @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </td>
       
       </tr>
       <tr>
         <th>Password</th>
         <td><input type="text" name="password" form="userForm"  class="form-control form-control-user @error('password') is-invalid @enderror" value="{{ $tenant->password }}" required>
        <br>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </td>
         
       </tr>
    
     </table>
   </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-sm text-white-50"></i> Close </button>
    <button type="submit" form="userForm" class="btn btn-primary"><i class="fas fa-check"></i> Create</button> 
  </div> 
  </div>
  </div>
  
  </div>
@endsection



@section('scripts')
<script type="text/javascript">
  //adding moveout charges upon moveout
    $(document).ready(function(){
        var i=1;
    $("#add_row").click(function(){
        $('#addr'+i).html("<th id='value'>"+ (i) +"</th><td><input class='form-control' form='requestMoveoutForm' name='billing_desc"+i+"' id='desc"+i+"' type='text' required></td><td><input class='form-control' form='requestMoveoutForm'    oninput='autoCompute("+i+")' name='price"+i+"' id='price"+i+"' type='number' min='1' required></td><td><input class='form-control' form='requestMoveoutForm'  oninput='autoCompute("+i+")' name='qty"+i+"' id='qty"+i+"' value='1' type='number' min='1' required></td><td><input class='form-control' form='requestMoveoutForm' name='billing_amt"+i+"' id='amt"+i+"' type='number' min='1' required readonly value='0'></td>");
     $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     i++;
     document.getElementById('no_of_charges').value = i;
    });
    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        document.getElementById('no_of_charges').value = i;
        }
    });
        var j=1;
    $("#add_charges").click(function(){
      $('#row'+j).html("<th>"+ (j) +"</th><td><select class='form-control' name='billing_desc"+j+"' form='extendTenantForm' id='billing_desc"+j+"'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option><option value='Rent'>Rent</option><option value='Electric'>Electric</option><option value='Water'>Water</option></select> <td><input class='form-control' form='extendTenantForm' name='billing_start"+j+"' id='billing_start"+j+"' type='date' value='{{ $tenant->moveout_date }}' required></td> <td><input class='form-control' form='extendTenantForm' name='billing_end"+j+"' id='billing_end"+j+"' type='date' required></td> <td><input class='form-control' form='extendTenantForm'   name='billing_amt"+j+"' id='billing_amt"+j+"' type='number' min='1' step='0.01' required></td>");
     $('#extend_table').append('<tr id="row'+(j+1)+'"></tr>');
     j++;
     
        document.getElementById('no_of_items').value = j;
 });
    $("#remove_charges").click(function(){
        if(j>1){
        $("#row"+(j-1)).html('');
        j--;
        
        document.getElementById('no_of_items').value = j;
        }
    });
    var k=1;
    $("#add_bill").click(function(){
      $('#bill'+k).html("<th>"+ (k) +"</th><td><select class='form-control' name='billing_desc"+k+"' form='addBillForm' id='billing_desc"+k+"'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option><option value='Rent'>Rent</option><option value='Electric'>Electric</option><option value='Water'>Water</option></select> <td><input class='form-control' form='addBillForm' name='billing_start"+k+"' id='billing_start"+k+"' type='date' value='{{ $tenant->movein_date }}' required></td> <td><input class='form-control' form='addBillForm' name='billing_end"+k+"' id='billing_end"+k+"' type='date' value='{{ $tenant->moveout_date }}' required></td> <td><input class='form-control' form='addBillForm' name='billing_amt"+k+"' id='billing_amt"+k+"' type='number' min='1' step='0.01' required></td>");
     $('#table_bill').append('<tr id="bill'+(k+1)+'"></tr>');
     k++;
     
        document.getElementById('no_of_bills').value = k;
 });
    $("#delete_bill").click(function(){
        if(k>1){
        $("#bill"+(k-1)).html('');
        k--;
        
        document.getElementById('no_of_bills').value = k;
        }
    });
});
</script>

<script>
  function autoCompute(val) {
    price = document.getElementById('price'+val).value;
    qty = document.getElementById('qty'+val).value;
    
    amt = document.getElementById('amt'+val).value =  parseFloat(price) *  parseFloat(qty);
   
  }
</script>

<script type="text/javascript">

  //adding moveout charges upon moveout
    $(document).ready(function(){
    var j=1;
    $("#add_payment").click(function(){
        $('#payment'+j).html("<th>"+ (j) +"</th><td><select class='form-control' form='acceptPaymentForm' name='billing_no"+j+"' id='billing_no"+j+"' required><option >Please select bill</option> @foreach ($balance as $item)<option value='{{ $item->billing_no.'-'.$item->billing_id }}'> Bill No {{ $item->billing_no }} | {{ $item->billing_desc }} | {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} - {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }} | {{ number_format($item->balance,2) }} </option> @endforeach </select></td><td><input class='form-control'  form='acceptPaymentForm' name='amt_paid"+j+"' id='amt_paid"+j+"' type='number' min='1' step='0.01' required></td><td><select class='form-control'  form='acceptPaymentForm' name='form_of_payment"+j+"' required><option value='Cash'>Cash</option><option value='Bank Deposit'>Bank Deposit</option><option value='Cheque'>Cheque</option></select></td><td>  <input class='form-control'  form='acceptPaymentForm' type='text' name='bank_name"+j+"'></td><td><input class='form-control'  form='acceptPaymentForm' type='text' name='cheque_no"+j+"'></td>");
  
  
     $('#payment').append('<tr id="payment'+(j+1)+'"></tr>');
     j++;
     document.getElementById('no_of_payments').value = j;
  
    });
  
    $("#delete_payment").click(function(){
        if(j>1){
        $("#payment"+(j-1)).html('');
        j--;
        document.getElementById('no_of_payments').value = j;
        }
    });
  });
</script>
@endsection



