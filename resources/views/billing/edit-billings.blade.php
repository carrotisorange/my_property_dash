@extends('layouts.sm-2.template')

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
            <li class="nav-item active">
              <a class="nav-link" href="/tenants">
                <i class="fas fa-users fa-chart-area"></i>
                <span>Tenants</span></a>
            </li>
            @endif
      
       @if((Auth::user()->user_type === 'admin' && Auth::user()->property_ownership === 'Multiple Owners') || (Auth::user()->user_type === 'manager' && Auth::user()->property_ownership === 'Multiple Owners'))
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
            <a class="nav-link" href="/payables">
            <i class="fas fa-hand-holding-usd"></i>
              <span>Payables</span></a>
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
@if(Auth::user()->user_type === 'manager')
<a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}#bills" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Bills</a>
@else
<a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/billings" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Bills</a>
@endif
<a href="#" data-toggle="modal" data-target="#addBill" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>
{{-- <button data-toggle="modal" data-target="#editPaymentFooter" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-sm text-white-50"></i> Edit Footer</button> --}}


<br><br>
<div class="row">
  <div class="col-md-12">
    <p>
      <b>Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->format('M d Y') }}
      <br>
      <span class="text-danger"><b>Due Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->addDays(7)->format('M d Y') }}</span>
      <br>
      <b>To:</b> {{ $tenant->first_name.' '.$tenant->last_name }}
      <br>
      <b>Room:</b> {{ $room->building.' '.$room->unit_no }}</b>
     
    </p>
    <form id="editBillsForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/billings/edit" method="POST">
      @csrf
      @method('PUT')
    </form>
    <p class="text-right">Statement of Accounts </p>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <?php $ctr=1; ?>
        <tr>
          <th class="text-center">#</th>
          <th>Bill No</th>
         
          <th>Description</th>
          <th colspan="2">Period Covered</th>
          <th>Amount</th>
          <td></td>
        </tr>

        <?php
          $billing_start_ctr = 1;
          $billing_end_ctr = 1;
          $billing_amt = 1;
          $billing_id_ctr =1;
        ?>
        @foreach ($balance as $item)
        <tr>
            <th class="text-center">{{ $ctr++ }}</th>
            <td>{{ $item->billing_no }} <input form="editBillsForm" type="hidden" name="billing_id_ctr{{ $billing_id_ctr++ }}" value="{{ $item->billing_id }}"></td>
    
            <td>{{ $item->billing_desc }}</td>
            <td>
              <input class="form-control" form="editBillsForm" type="date" name="billing_start_ctr{{ $billing_start_ctr++ }}" value="{{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('Y-m-d') : null}}"> 
            </td>
            <td>
              <input class="form-control" form="editBillsForm"  type="date" name="billing_end_ctr{{ $billing_end_ctr++ }}" value="{{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('Y-m-d') : null }}">
            </td>
            <td><input class="form-control" form="editBillsForm" type="number" name="billing_amt_ctr{{ $billing_amt++ }}" step="0.01" value="{{  $item->balance }}"></td>
            <td>
              @if(Auth::user()->user_type === 'manager')
  
              <form action="/tenants/{{ $item->billing_tenant_id }}/billings/{{ $item->billing_id }}" method="POST">
                @csrf
                @method('delete')
                <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
              </form>
              @endif
            </td>   
          </tr>
        @endforeach
        <tr>
          <th>Total</th>
          <th colspan="5" class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
         </tr>    
    </table>
  </div>
  <p>Message footer</p>
  <textarea form="editBillsForm" class="form-control" name="note" id="" cols="20" rows="10">
    {{ Auth::user()->note }}
    </textarea> 
    <br>
    <p class="text-right"><button form="editBillsForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button> </p>
  </div>
  <br>
</div>

{{-- Modal for editing payment footer message --}}
<div class="modal fade" id="editPaymentFooter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Enter Footer Message</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
         <form id="editPaymentFooterForm" action="/users/{{ Auth::user()->id }}" method="POST">
          @method('put')
          {{ csrf_field() }}
         </form>
          <textarea form="editPaymentFooterForm" class="form-control" name="note" id="" cols="30" rows="10">
          {{ Auth::user()->note }}
          </textarea>
        <input form="editPaymentFooterForm" type="hidden" name="action" value="change_footer_message">
      </div>
      <div class="modal-footer">
            {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> --}}
            <button form="editPaymentFooterForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
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
   {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button> --}}
   <button form="addBillForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
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
        $('#addr'+i).html("<th>"+ (i) +"</th><td><select class='form-control' name='billing_desc"+i+"' form='addBillForm' id='billing_desc"+i+"'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option><option value='Rent'>Rent</option><option value='Electric'>Electric</option><option value='Water'>Water</option></select> <td><input class='form-control' form='addBillForm' name='billing_start"+i+"' id='billing_start"+i+"' type='date' value='{{ Carbon\Carbon::parse($tenant->movein_date)->format('Y-m-d') }}'></td> <td><input class='form-control' form='addBillForm' name='billing_end"+i+"' id='billing_end"+i+"' type='date' value='{{ Carbon\Carbon::parse($tenant->moveout_date)->format('Y-m-d') }}'></td> <td><input class='form-control' form='addBillForm'   name='billing_amt"+i+"' id='billing_amt"+i+"' type='number' min='1' step='0.01' value='{{ $tenant->tenant_monthly_rent }}' required></td>");
  
  
     $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     i++;
    
     document.getElementById('no_of_items').value = i;
  
    });
  
    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        current_bill_no--;
        document.getElementById('no_of_items').value = i;
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
<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'note', {
      filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form',
  });
  </script>

@endsection



