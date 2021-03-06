@extends('templates.webapp-new.template')

@section('title', $owner->unit_owner)

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
              <a class="nav-link" href="/property/{{$property->property_id }}/tenants">
                <i class="fas fa-user text-green"></i>
                <span class="nav-link-text">Tenants</span>
              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link active" href="/property/{{$property->property_id }}/owners">
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
              <a class="nav-link" href="/property/{{$property->property_id }}}/personnels">
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
<div class="row align-items-center py-4">
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-dark d-inline-block mb-0">{{ $owner->unit_owner }}</h6>
    
  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-owner-tab" data-toggle="tab" href="#owner" role="tab" aria-controls="nav-owner" aria-selected="true"><i class="fas fa-user-tie fa-sm text-primary-50"></i> Profile</a>
          <a class="nav-item nav-link" id="nav-rooms-tab" data-toggle="tab" href="#rooms" role="tab" aria-controls="nav-rooms" aria-selected="false"><i class="fas fa-home fa-sm text-primary-50"></i> Rooms <span class="badge badge-primary">{{ $units->count() }}</span></a>
          {{-- <a class="nav-item nav-link" id="nav-bills-tab" data-toggle="tab" href="#bills" role="tab" aria-controls="nav-bills" aria-selected="false"><i class="fas fa-file-signature fa-sm text-primary-50"></i> Bills <span class="badge badge-primary badge-counter">{{ $bills->count() }}</span></a> --}}
        </div>
      </nav>
        
    </div>
 
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="owner" role="tabpanel" aria-labelledby="nav-owner-tab">
        <div class="row">
          <div class="col-md-8">
            <a href="/property/{{ $property->property_id }}/owners"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
            <a href="/property/{{ $property->property_id }}/owner/{{ $owner->unit_owner_id }}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
            <br><br>
  
               <div class="table-responsive text-nowrap">
                 <table class="table" >
                    <tr>
                        <td>Owner</td>
                        <td>{{ $owner->unit_owner }}</td>
                    </tr>
                    <tr>
                     <td>Email</td>
                     <td>{{ $owner->investor_email_address }}</td>
                 </tr>
                  <tr>
                     <td>Mobile</td>
                     <td>{{ $owner->investor_contact_no }}</td>
                 </tr>
                 <tr>
                   <td>Representative</td>
                   <td>{{ $owner->investor_representative }}</td>
               </tr>
               <tr>
                 <td>Address</td>
                 <td>{{ $owner->investor_address }}</td>
               </tr>
          
               
                 </table>
               </div>
         
           
          </div>
          <div class="col-md-4">
         
           <img  src="{{ $owner->tenant_img? asset('/storage/tenants/'.$owner->tenant_img): asset('/arsha/assets/img/no-image.png') }}" alt="..." class="img-thumbnail">
          
           <form id="uploadImageForm" action="/units/{{ $owner->unit_tenant_id }}/tenants/{{ $owner->tenant_id }}/edit/img" method="POST" enctype="multipart/form-data">
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
       
         </div> </div>
      </div>
      <div class="tab-pane fade" id="rooms" role="tabpanel" aria-labelledby="nav-rooms-tab">
        {{-- <a href="#/"  data-toggle="modal" data-target="#addRoomModal" data-whatever="@mdo" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
          <i class="fas fa-plus fa-sm text-white-50"></i> Add 
        </a>
        <br><br> --}}
        <div class="col-md-12 mx-auto">
          <div class="table-responsive text-nowrap">
            <?php $ctr = 1; ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Room</th>
                  <th>Building</th>
                  <th>Type</th>
                  <th>Floor No</th>
                  <th>Status</th>
                  <th>Monthly Rent</th>
                  <th>Occupancy</th>
                </tr>
              </thead>
             @foreach ($units as $item)
             <tbody>
              <tr>
                <th>{{ $ctr++ }}</th>
                <td><a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}">{{ $item->unit_no }}</a></td>
                <td>{{ $item->building }}</td>
                <td>{{ $item->type_of_units }}</td>
                <td>{{ $item->floor_no }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ number_format($item->monthly_rent, 2) }}</td>
                <td>{{ $item->max_occupancy }} pax</td>
              </tr>
            </tbody>
             @endforeach
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="bills" role="tabpanel" aria-labelledby="nav-bills-tab">
      
      </div>
    </div>
  </div>
</div>

@endsection

@section('main-content')

@endsection

@section('scripts')
  
@endsection



