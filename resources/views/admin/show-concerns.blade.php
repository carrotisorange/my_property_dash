@extends('layouts.app')

@section('title', $tenant->first_name.' '.$tenant->last_name)

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
        <li class="nav-item">
            <a class="nav-link" href="/owners">
            <i class="fas fa-user-tie"></i>
            <span>Owners</span></a>
        </li>
         @endif
      
         @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <!-- Nav Item - Tables -->
        <li class="nav-item active">
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
  <h1 class="h3 mb-0 text-gray-800">{{ $unit->building.' '.$unit->unit_no }}</h1>
</div>

<div class="row">
  <div class="col-md-12">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-concern-tab" data-toggle="tab" href="#concern" role="tab" aria-controls="nav-concern" aria-selected="true"><i class="far fa-comment-dots fa-sm text-primary-50"></i> Concern</a>
        <a class="nav-item nav-link" id="nav-responses-tab" data-toggle="tab" href="#responses" role="tab" aria-controls="nav-responses" aria-selected="false"><i class="fas fa-reply fa-sm text-primary-50"></i> Responses <span class="badge badge-primary badge-counter">{{ $responses->count() }}</span></a>
        <a class="nav-item nav-link" id="nav-expenses-tab" data-toggle="tab" href="#expenses" role="tab" aria-controls="nav-expenses" aria-selected="false"><i class="fas fa-dollar-sign fa-sm text-primary-50"></i> Expenses</a>
      </div>
    </nav>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="concern" role="tabpanel" aria-labelledby="nav-concern-tab">
        <br>
        <a href="#" data-toggle="modal" data-target="#editConcernDetails" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a> 
        <div class="col-md-11 mx-auto">
          <br>
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <tr>
                <td>Date Reported</td>
                <td>{{ Carbon\Carbon::parse($concern->date_reported)->format('M d Y') }}</td>
              </tr>
                 <tr>
                      <td>Reported by</th>
                      <td><a href="/units/{{ $unit->unit_id }}/tenants/{{ $tenant->tenant_id }}/">{{ $tenant->first_name.' '.$tenant->last_name }}</a></td>
                 </tr>     
             <tr>
                  <td>Description</td>
                  <td>{{ $concern->concern_item }}</td>
             </tr>
             <tr>
                  <td>Type</td>
                  <td>
                    {{ $concern->concern_type }}
                  </td>
             </tr>
            
             <tr>
                  <td>Urgency</td>
                  <td>
                    @if($concern->concern_urgency === 'urgent')
                    <span class="badge badge-danger">{{ $concern->concern_urgency }}</span>
                    @elseif($concern->concern_urgency === 'major')
                    <span class="badge badge-warning">{{ $concern->concern_urgency }}</span>
                    @else
                    <span class="badge badge-primary">{{ $concern->concern_urgency }}</span>
                    @endif
                  </td>
             </tr>
             <tr>
                <td>Status</td>
                  <td>
                      @if($concern->concern_status === 'pending')
                      <span class="badge badge-warning">{{ $concern->concern_status }} for {{ number_format(Carbon\Carbon::parse($concern->date_reported)->DiffInDays(Carbon\Carbon::now()), 0) }} days</span>
                      @elseif($concern->concern_status === 'active')
                      <span class="badge badge-primary">{{ $concern->concern_status }} for {{ number_format(Carbon\Carbon::parse($concern->date_reported)->DiffInDays(Carbon\Carbon::now()), 0) }} days </span> 
                      @else
                      <span class="badge badge-secondary">{{ $concern->concern_status }} on {{ Carbon\Carbon::parse($concern->updated_at)->format('M d Y')}}</span> 
                      @endif
                  </td>
             </tr>
             <tr>
               <td colspan="2">Concern</td>
             </tr>
             <tr>
               <td colspan="2" class="text-center">{{ $concern->concern_desc }}</td>
             </tr>
            
            
             </table>
            </div>
        </div>
      </div>
      <div class="tab-pane fade" id="responses" role="tabpanel" aria-labelledby="nav-responses-tab">
      
       
        {{-- <a href="#" data-toggle="modal" data-target="#addResponse" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>  --}}
        <div class="col-md-11 mx-auto"> 
          <br>   
          <blockquote class="blockquote mb-0">Concern</blockquote><p>{{ $concern->concern_desc }}</p>
          <hr>
          <form action="/responses" method="POST">
            @csrf
            <textarea class="form-control" name="response" id="" cols="30" rows="3" placeholder="type your response here..."></textarea>
            <input type="hidden" name="concern_id" value="{{ $concern->concern_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit->unit_id }}">
            <input type="hidden" name="tenant_id" value="{{ $tenant->tenant_id }}">
            <br>
            <p class="text-right">
              <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-reply fa-sm text-white-50"></i> response </button>
            </p>
          </form>
          <hr>
          
         @foreach ($responses as $item)
         <div class="card">
          <div class="card-body">
            <blockquote class="blockquote mb-0">
              <p>{{ $item->response }}</p>
              <footer class="blockquote-footer">posted by <cite title="Source Title">{{ $item->posted_by }}</cite> on {{ Carbon\Carbon::parse($item->created_at)->format('M d Y H:m:s') }}</footer>
            </blockquote>
          </div>
        </div>
        <br>
         @endforeach
     
        </div>
      </div>
      <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="nav-expenses-tab">...</div>
    </div>
  </div>
</div>


<div class="modal fade" id="editConcernDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Concern</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <form id="editConcernDetailsForm" action="/concerns/{{ $concern->concern_id }}" method="POST">
        @method('put')
        {{ csrf_field() }}
      </form>
        <div class="row">
            <div class="col">
                <small>Date reported</small>
                <input type="date" form="editConcernDetailsForm" class="form-control" name="date_reported" value="{{ $concern->date_reported }}" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <small>Description</small>
                <input type="text" form="editConcernDetailsForm" class="form-control" name="concern_item" value="{{ $concern->concern_item }}" required>
            </div>
        </div>
      
        <div class="row">
            <div class="col">
                <small>Type</small>
                <select class="form-control" form="editConcernDetailsForm" name="concern_type" id="" required>
                    <option value="{{ $concern->concern_type }}" readonly selected class="bg-primary">{{ $concern->concern_type }}</option>
                    <option value="billing">billing</option>
                    <option value="internet">internet</option>
                    <option value="employee">employee</option>
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

        <div class="row">
            <div class="col">
                <small>Urgency</small>
                <select class="form-control" form="editConcernDetailsForm" name="concern_urgency" id="" required>
                    <option value="{{ $concern->concern_urgency }}" readonly selected class="bg-primary">{{ $concern->concern_urgency }}</option>
                   <option value="minor">minor</option>
                   <option value="major">major</option>
                   <option value="urgent">urgent</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <small>Status</small>
                <select class="form-control" form="editConcernDetailsForm" name="concern_status" id="" required>
                    <option value="{{ $concern->concern_status }}" readonly selected class="bg-primary">{{ $concern->concern_status }}</option>
                   <option value="pending">pending</option>
                   <option value="active">active</option>
                   <option value="closed">closed</option>
                </select>
            </div>
        </div>

        <div class="row">
          <div class="col">
              <small>Concern</small>
             <textarea form="editConcernDetailsForm" class="form-control" name="concern_desc" id="" cols="30" rows="10" value="{{ $concern->concern_desc }}">
              The tenant reports a flickering light and the rusty cabinet hinges in her unit.
             </textarea>
          </div>
      </div>

      </div>
      <div class="modal-footer">

          <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>
      </div>
  </div>
  </div>

</div>

{{-- <div class="modal fade" id="addResponse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add Response</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
     
        <div class="row">
            <div class="col">
                <small>Date reported</small>
                <input type="date" form="editConcernDetailsForm" class="form-control" name="date_reported" value="{{ $concern->date_reported }}" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">

          <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>
      </div>
  </div>
  </div>

</div> --}}

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
      var i=1;
  $("#add_row").click(function(){
      $('#addr'+i).html("<th>"+ (i) +"</th><td><input form='moveoutTenantForm' name='desc"+i+"' id='desc"+i+"' type='text' class='form-control input-md'></td><td><input form='moveoutTenantForm'   name='qty"+i+"' id='qty"+i+"' type='number' min='1' class='form-control input-md' required></td><td><input form='moveoutTenantForm'   name='price"+i+"' id='price"+i+"' type='number' min='1' class='form-control input-md' required></td><td><input form='moveoutTenantForm' step='0.01' name='amt"+i+"' id='amt"+i+"' type='number' min='1' class='form-control input-md' readonly required></td>");


   $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
   i++;

   document.getElementById('no_of_items').value = i;
});

  $("#delete_row").click(function(){
      if(i>1){
      $("#addr"+(i-1)).html('');
      i--;
      document.getElementById('no_of_items').value = i;
      }
  });
});
</script>
<script>
$(document).ready(function(){

  if(document.getElementById('action_taken').innerHTML === ""){
    $("#editActionTakenForm").modal('show');
  }

});
</script>

@endsection



