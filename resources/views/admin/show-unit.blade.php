@extends('layouts.app')

@section('title', $unit->building.' '.$unit->unit_no)

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
          <li class="nav-item active">
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
        <li class="nav-item">
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
    @if(Auth::user()->user_type === 'manager' )
      <button type="button" title="edit room" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#editUnit" data-whatever="@mdo"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Room</button> 
    @endif 

   
    @if ($unit_owner->count() < 1)
    <a href="#/" data-toggle="modal" data-target="#addInvestor" data-whatever="@mdo" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-user-plus fa-sm text-white-50"></i> Add Owner
    </a>   
    @endif

    @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
    <a href="#" data-toggle="modal" data-target="#addBill" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Bill</a>
    @endif
    
      <br> <br>
          <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
             <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">UNIT INFORMATION</h6>
             </div>
             <div class="card-body">
              <div class="table-responsive text-nowrap">
            <table class="table table-striped" >
                 <tr>
                      <td>Unit No</td>
                      <td>{{ $unit->unit_no }}</td>
                 </tr>
                
                  <tr>
                      <td>Building</td>
                      <td>{{ $unit->building }}</td>
                 </tr>
                 <tr>
                      <td>Floor No</td>
                      <td>{{ $numberFormatter->format($unit->floor_no) }}</td>
                 </tr>
                 <tr>
                      <td>Unit Type</td>
                      <td>{{ $unit->type_of_units }}</td>
                 </tr>
               
                  
                  <tr>
                     

                      <?php 
                          session([Auth::user()->id.'tenant_monthly_rent'=> $unit->monthly_rent]);
                          session([Auth::user()->id.'unit_id'=> $unit->unit_id]);
                          session([Auth::user()->id.'unit_no'=> $unit->unit_no]);
                          session([Auth::user()->id.'building'=> $unit->building]);
                      ?>
                  </tr>
        
             </table>
            </div>
             </div>
           </div>
   

  </div>



  <div class="col-lg-12 mb-4">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">OWNERS </h6>
      </div>
     <div class="card-body">
      <div class="table-responsive text-nowrap">
      <table class="table table-striped">
      <tr>

        <th>OWNER</th>
        <th>EMAIL</th>
        <th>MOBILE</th>
        <th>REPRESENTATIVE</th>
        <th>DATE PURCHASED</th>
        <th>DATE ACCEPTED</th>
        <th>ROOM TYPE</th>
            </tr>
            @foreach ($unit_owner as $item)
            <tr>
               <td><a href="{{ route('show-investor',['unit_id'=> $item->unit_id, 'unit_owner_id'=>$item->unit_owner_id]) }}">{{ $item->unit_owner }} </a></td>
        
              <td>{{ $item-> investor_email_address}}</td>
              <td>{{ $item->investor_contact_no }}</td>
              <TD>{{ $item->investor_representative }}</TD>
              <td>{{ $item->date_invested ? Carbon\Carbon::parse($item->date_invested)->format('M d Y') : null}}</td> 
              <td> {{ $item->date_accepted ? Carbon\Carbon::parse($item->date_accepted)->format('M d Y') : null}}</td> 
              <td>{{ $item->type_of_units }}</td>
            </tr>
            @endforeach
      
            
      </table>

     
    </div>
     </div>
   </div>

      
  </div>


<div class="col-lg-12 mb-4">
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">BILLING HISTORY</h6>
</div>
<div class="card-body">
<div class="table-responsive text-nowrap">
<table class="table table-striped" >
<tr>
  <th>BILL NO</th>
  <th>OWNER</th>
  <th>DESCRIPTION</th>
  <th colspan="2">PERIOD COVERED</th>
  <th>AMOUNT</th>
 
</tr>
@foreach ($unit_bills as $item)
<tr>
    <td>{{ $item->billing_no }}</td>
    <td> <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}">{{ $item->first_name.' '.$item->last_name }}</a></td>
    <td>{{ $item->billing_desc }}</td>
    <td colspan="2">
      {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
      {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
    </td>
    <td>{{ number_format($item->billing_amt,2) }}</td>
    {{-- <td>
    @if($item->billing_status === 'paid')
    <span class="badge badge-success">{{ $item->billing_status }}</span>
     @else
    <span class="badge badge-danger">{{ $item->billing_status }} </span>
     @endif
     </td> --}}
</tr>
@endforeach


</table>

{{ $unit_bills->links() }}
</div>
</div>
</div>


</div> 

<div class="col-lg-12 mb-4">
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">CONCERNS HISTORY</h6>
</div>
<div class="card-body">
<div class="table-responsive text-nowrap">

<table class="table table-striped" >
<thead>
 <tr>
  
     <th>DATE REPORTED</th>
    <th>OWNER</th>

     <th>TYPE</th>
     <th>DESCRIPTION</th>
     <th>URGENCY</th>
     <th>STATUS</th>
    
</tr>
</thead>
<tbody>
 @foreach ($concerns as $item)
 <tr>

  <td> {{ $item->date_reported ? Carbon\Carbon::parse($item->date_reported)->format('M d Y') : null}}</td>
   <td>
          <a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
      </td>
    
     <td>
       
         {{ $item->concern_type }}
         
     </td>
     <td ><a title="{{ $item->concern_desc }}" href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/concerns/{{ $item->concern_id }}">{{ $item->concern_item }}</a></td>
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
         <span class="badge badge-secondary">{{ $item->concern_status }}</span>
         @endif
     </td>
   
 </tr>
 @endforeach
</tbody>
</table>

{{ $concerns->links() }}
</div>
</div>
</div>


</div>  

{{-- Modal to edit unit --}}

<div class="modal fade" id="editUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Room Information</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<form id="editUnitForm" action="/units/{{$unit->unit_id }}" method="POST">
    @method('put')
    {{ csrf_field() }}
</form>
<div class="modal-body">
<form>
    <div class="form-group">
    <small>Room No</small>
    <input form="editUnitForm" type="text" value="{{ $unit->unit_no }}" name="unit_no" class="form-control" id="unit_no" >
    </div>
    <div class="form-group">
      <small>Building</small>
      <input form="editUnitForm" type="text" value="{{ $unit->building }}" name="building" class="form-control"> 
    </div>
    <div class="form-group">
    <small>Floor no</small>
    <select form="editUnitForm" id="floor_no" name="floor_no" class="form-control">
        <option value="{{ $unit->floor_no }}" readonly selected class="bg-primary">{{ $unit->floor_no }}</option>
        <option value="-5">5th basement</option>
        <option value="-4">4th basement</option>
        <option value="-3">3rd basement</option>
        <option value="-2">2nd basement</option>
        <option value="-1">1st basement</option>
        
        <option value="1">1st floor</option>
        <option value="2">2nd floor</option>
        <option value="3">3rd floor</option>
        <option value="4">4th floor</option>
        <option value="5">5th floor</option>
        <option value="6">6th floor</option>
        <option value="7">7th floor</option>
        <option value="8">8th floor</option>
        <option value="9">9th floor</option>
    </select>
    </div>

    <div class="form-group">
    <small>Room Type</small>
    <select form="editUnitForm" id="type_of_units" name="type_of_units" class="form-control">
        <option value="{{ $unit->type_of_units }}" readonly selected class="bg-primary">{{ $unit->type_of_units }}</option>
        <option value="commercial">commercial</option>
        <option value="residential">residential</option>
    </select>
    </div>
 
</form>
</div>
<div class="modal-footer">
<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
<button type="submit" form="editUnitForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>  
</div>
</div>
</div>
</div>

{{-- Modal to add investor --}}
<div class="modal fade" id="addInvestor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Enter the owner information</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<form id="addInvestorForm" action="/units" method="POST">
    {{ csrf_field() }}
</form>
<div class="modal-body">
    <input form="addInvestorForm" type="hidden" value="{{ $unit->unit_id }}" name="unit_id">
  

    <div class="form-group">
    <small>Name</small>
    <input form="addInvestorForm" type="text"  value="{{ $unit->unit_owner }}" class="form-control" name="unit_owner" id="unit_owner" required>
    </div>
    <div class="form-group">
        <small>Email</small>
        <input form="addInvestorForm" type="email" class="form-control" name="investor_email_address" id="investor_email_address">
    </div>
    <div class="form-group">
        <small>Mobile</small>
        <input form="addInvestorForm" type="text" class="form-control" name="investor_contact_no" id="contact_no">
    </div>            
</div>
<div class="modal-footer">
<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
<button type="submit" form="addInvestorForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Add Owner</button>  
</div>
</div>
</div>
</div>

{{-- Modal to enroll leasing to unit owner --}}
<div class="modal fade" id="enrollLeasing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Enter Leasing Information</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<form id="enrollLeasingForm" action="/units/{{$unit->unit_id }}" method="POST">
@method('put')
{{ csrf_field() }}

<input form="enrollLeasingForm" type="hidden" value="enroll_leasing" name="action">
</form>
<div class="modal-body">
<div class="form-group">
  <small>Date of Enrollment Starts</small>
  <input form="enrollLeasingForm" type="date"  class="form-control" name="date_enrolled" required>
  </div>
  <div class="form-group">
  <small>Contract Starts</small>
  <input form="enrollLeasingForm" type="date"  class="form-control" name="contract_start" required>
  </div>
  <div class="form-group">
      <small>Contract Ends</small>
      <input form="enrollLeasingForm" type="date" class="form-control" name="contract_end" required>
  </div>
  <div class="form-group">
    <small>Occupancy</small>
    <input form="enrollLeasingForm" type="number" class="form-control" name="max_occupancy" required >
</div>   
  <div class="form-group">
      <small>Monthly Rent</small>
      <input form="enrollLeasingForm" type="number" step="0.01" class="form-control" name="monthly_rent" required >
  </div>            
</div>
<div class="modal-footer">
<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
<button type="submit" form="enrollLeasingForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Enroll Now</button>  
</div>
</div>
</div>
</div>


   {{-- Modal for warning message --}}
   <div class="modal fade" id="warningTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
           <p class="text-center">
                You can't add tenant. The room is fully occupied.
                <br>
                <small class="text-danger">
                  You may increase the number of max occupancy to allow more tenants.
                </small>
           </p>
        </div>
        
    </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection



