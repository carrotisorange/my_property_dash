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
      
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'treasury' && (Auth::user()->property_ownership === 'Multiple Owners'))
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
<div class="row">
  <div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Rooms</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Bills</a>
        </div>
      </nav>
        
    </div>
 
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row">
          <div class="col-md-8">
            <a href="/units/{{ $unit->unit_id }}/owners/{{ $investor->unit_owner_id }}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-sm text-white-50"></i> Edit Owner</a>
            <br><br>
           <div class="card shadow mb-4">
             {{-- <div class="card-header py-3">
               OWNER INFORMATION
             </div> --}}
             <div class="card-body">
               
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
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
    </div>
  </div>
</div>


@endsection

@section('scripts')

@endsection



