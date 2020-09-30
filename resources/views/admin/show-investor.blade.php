@extends('layouts.app')

@section('title', $investor->unit_owner)

@section('sidebar')
      <!-- Nav Item - Dashboard -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/board">
            <div class="sidebar-brand-icon">
               <i class="fab fa-product-hunt"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ Auth::user()->property }}<sup></sup></div>
          </a>
      
          <!-- Divider -->
          <hr class="sidebar-divider my-0">
      
           <!-- Heading -->
      
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
                <a class="nav-link" href="/board">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
              </li>
      
            <hr class="sidebar-divider">
      
            <div class="sidebar-heading">
              Interface
            </div>  
          @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
          <li class="nav-item">
            <a class="nav-link" href="/home">
              <i class="fas fa-home"></i>
              <span>Home</span></a>
          </li>
          @endif
        
          @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
            <li class="nav-item">
              <a class="nav-link" href="/tenants">
                <i class="fas fa-users fa-chart-area"></i>
                <span>Tenants</span></a>
            </li>
            @endif
      
       @if((Auth::user()->user_type === 'admin' && Auth::user()->property_ownership === 'Multiple Owners') || (Auth::user()->user_type === 'manager' && Auth::user()->property_ownership === 'Multiple Owners'))
        <!-- Nav Item - Tables -->
        <li class="nav-item active">
            <a class="nav-link" href="/owners">
            <i class="fas fa-user-tie"></i>
            <span>Owners</span></a>
        </li>
         @endif
      
         @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/concerns">
          <i class="far fa-comment-dots"></i>
              <span>Concerns</span></a>
        </li>
        @endif
    
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
        <li class="nav-item">
            <a class="nav-link" href="/job-orders">
              <i class="fas fa-tools fa-table"></i>
              <span>Job Orders</span></a>
        </li>
        @endif
      
             <!-- Nav Item - Tables -->
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
          <li class="nav-item">
            <a class="nav-link collapsed" href="/personnels" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-user-cog"></i>
                <span>Personnels</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="/housekeeping">Housekeeping</a>
                  <a class="collapse-item" href="/maintenance">Maintenance</a>
                </div>
              </div>
            </li>
        @endif
      
           @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
            <!-- Nav Item - Tables -->
            <li class="nav-item">
              <a class="nav-link" href="/bills">
                <i class="fas fa-file-invoice-dollar fa-table"></i>
                <span>Bills</span></a>
            </li>
           @endif
      
           @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
              <li class="nav-item">
              <a class="nav-link" href="/collections">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Collections</span></a>
            </li>
            @endif
      
               @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'ap' || Auth::user()->user_type === 'admin')
            <li class="nav-item">
            <a class="nav-link" href="/account-payables">
            <i class="fas fa-hand-holding-usd"></i>
              <span>Account Payables</span></a>
          </li>
          @endif
      
          @if(Auth::user()->user_type === 'manager')
           <!-- Nav Item - Tables -->
           <li class="nav-item">
            <a class="nav-link" href="/users">
              <i class="fas fa-user-circle"></i>
              <span>Users</span></a>
          </li>
          @endif
          
          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
      
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
    
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">{{ $investor->unit_owner}}</h1>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-owner-tab" data-toggle="tab" href="#owner" role="tab" aria-controls="nav-owner" aria-selected="true"><i class="fas fa-user-tie fa-sm text-primary-50"></i> Profile</a>
          <a class="nav-item nav-link" id="nav-rooms-tab" data-toggle="tab" href="#rooms" role="tab" aria-controls="nav-rooms" aria-selected="false"><i class="fas fa-home fa-sm text-primary-50"></i> Rooms <span class="badge badge-primary">{{ $units->count() }}</span></a>
          <a class="nav-item nav-link" id="nav-bills-tab" data-toggle="tab" href="#bills" role="tab" aria-controls="nav-bills" aria-selected="false"><i class="fas fa-file-signature fa-sm text-primary-50"></i> Bills <span class="badge badge-primary badge-counter">{{ $bills->count() }}</span></a>
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
            <a href="/units/{{ $unit->unit_id }}"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
            <a href="/units/{{ $unit->unit_id }}/owners/{{ $investor->unit_owner_id }}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
            <br><br>
  
               <div class="table-responsive text-nowrap">
                 <table class="table" >
                    <tr>
                        <td>Owner</td>
                        <td>{{ $investor->unit_owner }}</td>
                    </tr>
                    <tr>
                     <td>Email</td>
                     <td>{{ $investor->investor_email_address }}</td>
                 </tr>
                  <tr>
                     <td>Mobile</td>
                     <td>{{ $investor->investor_contact_no }}</td>
                 </tr>
                 <tr>
                   <td>Representative</td>
                   <td>{{ $investor->investor_representative }}</td>
               </tr>
               <tr>
                 <td>Address</td>
                 <td>{{ $investor->investor_address }}</td>
               </tr>
               @if($unit->type_of_units === 'leasing')
                 <tr>
                   <td>Bank Name</td>
                   <td>{{ $investor->bank_name }}</td>
               </tr>
               <tr>
                 <td>Account Name</td>
                 <td>{{ $investor->account_name }}</td>
               </tr>
               <tr>
               <td>Account Number</td>
               <td>{{ $investor->account_number }}</td>
               </tr>
               @endif
               
                 </table>
               </div>
         
           
          </div>
          <div class="col-md-4">
         
           <img  src="{{ $investor->tenant_img? asset('/storage/tenants/'.$investor->tenant_img): asset('/arsha/assets/img/no-image.png') }}" alt="..." class="img-thumbnail">
          
           <form id="uploadImageForm" action="/units/{{ $investor->unit_tenant_id }}/tenants/{{ $investor->tenant_id }}/edit/img" method="POST" enctype="multipart/form-data">
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
        <div class="col-md-11 mx-auto">
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
                <td><a href="/units/{{ $item->unit_id }}">{{ $item->unit_no }}</a></td>
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
        {{-- <a href="#" data-toggle="modal" data-target="#addBill" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a> 
        @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
          <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/billings/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
          @endif
          @if($balance->count() > 0)
          <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/download" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export</span></a>
          @endif
          @if($tenant->email_address !== null)
          <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/send" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-paper-plane  fa-sm text-white-50"></i> Send</span></a>
          @endif --}}

    <div class="col-md-11 mx-auto">
    <div class="table-responsive">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
          <?php $ctr=1; ?>
          <tr>
         <th>#</th>
          <th>Date Billed</th>
            <th>Bill No</th>
  
            <th>Description</th>
            <th>Period Covered</th>
            <th class="text-right" colspan="3">Amount</th>
            
          </tr>
          @foreach ($bills as $item)
          <tr>
         <th>{{ $ctr++ }}</th>
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
         <th class="text-right">{{ number_format($bills->sum('balance'),2) }} </th>
        </tr>
     
        
      </table>
    </div>
    </div>
      </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')

@endsection



