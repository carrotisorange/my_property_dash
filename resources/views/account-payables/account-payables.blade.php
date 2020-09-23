@extends('layouts.app')

@section('title', 'Account Payables')

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
            <li class="nav-item active">
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
  <h1 class="h3 mb-0 text-gray-800">Account Payables</h1>
</div>

<div class="row">
  <div class="col-md-12">
    @if(auth()->user()->user_type === 'ap' || auth()->user()->user_type === 'manager' )
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPayables" data-whatever="@mdo"><i class="fas fa-plus fa-sm text-white-50"></i> Add Entry</a>
    @endif
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#requestFunds" data-whatever="@mdo"><i class="fas fa-hand-holding-usd fa-sm text-white-50"></i> Request Funds</a>
  </div>
</div>
<br>
<p>Payable Entries</p>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Entry</th>
            <th>Added at</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $ctr = 1; ?>
          @foreach ($entry as $item)
             <tr>
              <th>{{ $ctr++ }}</th>
              <td>{{ $item->payable_entry }}</td>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
              <td> 
                @if(auth()->user()->user_type === 'ap' || auth()->user()->user_type === 'manager')
                <form action="/account-payable/{{ $item->id }}/" method="POST">
                  @csrf
                  @method('delete')
                  <button title="remove this entry" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                </form>
                @endif
               </td>
             </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<p>Payable Requests</p>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Entry</th>
            <th>Amount</th>
            <th>Date Requested</th>
            <th>Requested By</th>
            <th>Status</th>
            <th>Date Approved</th>
          
            <th colspan="2">Action</th>
            
          </tr>
        </thead>
        <tbody>
         
          @foreach ($request as $item)
             <tr>
              <th>{{ $item->no }}</th>
              <td>{{ $item->entry }}</td>
              <td>{{ number_format($item->amt, 2) }}</td>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
              <td>{{ $item->requested_by }}</td>
              <td>{{ $item->status }}</td>
             
               <td>{{ $item->updated_at? Carbon\Carbon::parse($item->updated_at)->format('M d Y'): '-' }}</td>
              {{-- <td>{{ $item->approved_by? $item->approved_by: 'pending' }}</td> --}} 
              @if($item->status === 'pending')
              <td> 
                <form action="/request-payable/disapprove/{{ $item->id }}/" method="POST">
                @csrf
                <button title="disapprove this request" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
              </form>
            </td>
            <td>
              <form action="/request-payable/approve/{{ $item->id }}/" method="POST">
                @csrf
      
                <button title="approve this request" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-check fa-sm text-white-50"></i></button>
              </form>
            </td>
              @else

              @endif
             </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="modal fade" id="addPayables" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >Add Entry</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <form id="addPayableEntryForm" action="/account-payable/add/{{ Auth::user()->property }}" method="POST">
           @csrf
        </form>
        
        <div class="row">
          <div class="col">
         
            <p class="text-right">
              <span id='delete_entry' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove </span>
            <span id="add_entry" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add </span>     
            </p>
              <div class="table-responsive text-nowrap">
              <table class = "table table-bordered" id="tab_logic">
                  <tr>
                      <th>#</th>
                      <th>Entry</th>
                  </tr>
                      <input form="addPayableEntryForm" type="hidden" id="no_of_entry" name="no_of_entry" >
                  <tr id='addr1'></tr>
              </table>
            </div>
          </div>
        </div>
        
     </div>
      <div class="modal-footer">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
          <button form="addPayableEntryForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check"></i> Save</button>
          </div>
  </div>
  </div>
</div>

<div class="modal fade" id="requestFunds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >Request Funds</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <form id="requestFundsForm" action="/account-payable/request/{{ Auth::user()->property }}" method="POST">
           @csrf
        </form>
        
        <div class="row">
          <div class="col">
         
            <p class="text-right">
              <span id='delete_request' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove </span>
            <span id="add_request" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add </span>     
            </p>
              <div class="table-responsive text-nowrap">
              <table class = "table table-bordered" id="request_table">
                  <tr>
                      <th>#</th>
                      <th>Entry</th>
                      <th>Amount</th>
                  </tr>
                      <input form="requestFundsForm" type="hidden" id="no_of_request" name="no_of_request" >
                  <tr id='request1'></tr>
              </table>
            </div>
          </div>
        </div>
        
     </div>
      <div class="modal-footer">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
          <button form="requestFundsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check"></i> Save</button>
          </div>
  </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
   $(document).ready(function(){
          var i=1;
          
      $("#add_entry").click(function(){
          $('#addr'+i).html("<th>"+ (i) +"</th><td><input class='col-md-12' form='addPayableEntryForm' name='payable_entry"+i+"' type='text'></td> ");
  
  
       $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
       i++;
       
       document.getElementById('no_of_entry').value = i;
  
      });
  
      $("#delete_entry").click(function(){
          if(i>1){
          $("#addr"+(i-1)).html('');
          i--;
          
          document.getElementById('no_of_entry').value = i;
          }
      });

      var j=1;
          
          $("#add_request").click(function(){
              $('#request'+j).html("<th>"+ (j) +"</th><td><select form='requestFundsForm' name='entry"+j+"' required>@foreach($entry as $item)<option value='{{ $item->payable_entry }}'>{{ $item->payable_entry }}</option> @endforeach</select></td><td><input form='requestFundsForm' name='amt"+j+"' type='number' step='0.001' required></td> ");
      
      
           $('#request_table').append('<tr id="request'+(j+1)+'"></tr>');
           j++;
           
           document.getElementById('no_of_request').value = j;
      
          });
      
          $("#delete_request").click(function(){
              if(j>1){
              $("#request"+(j-1)).html('');
              j--;
              
              document.getElementById('no_of_request').value = j;
              }
          });
    
  });
</script>
@endsection



