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
            <li class="nav-item active">
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
<a href="/board" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back Dashboard</a>

@if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
<a href="/tenants/search" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back to Tenants</a>
@else
<a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back to Tenant</a>
@endif

@if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
<a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/billings/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-gray-50"></i> Edit Bills</a>
@endif

  @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing')
  <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/payments" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-dollar-sign fa-sm text-white-50"></i> Show Payments <span class="badge badge-light">{{ $payments }}</span></a>
  @if($balance->count() > 0)
  <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/download" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Bills</span></a>
  @if($tenant->email_address !== null)
  <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/send" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-paper-plane  fa-sm text-white-50"></i> Send Bills</span></a>
  @endif
  @endif


@endif
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
    <p class="text-right">Statement of Accounts  
     
    </p>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <tr>
        <td></td>
          <th>Bill No</th>
         
          <th>Description</th>
          <th>Period Covered</th>
          <th class="text-right" colspan="3">Amount</th>
          
        </tr>
        @foreach ($balance as $item)
        <tr>
          <td>
          

            {{-- <form action="/tenants/{{ $item->billing_tenant_id }}/billings/{{ $item->billing_id }}" method="POST">
              @csrf
              @method('delete')
              <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
            </form> --}}
          
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
       @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
       <tr>
         <td colspan="2" class="text-right"><a href="#" data-toggle="modal" data-target="#acceptPayment" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Payment</a> </td>
       </tr>
       @endif     
    </table>
  </div>
  </div>
</div>

  <pre>
    {{ Auth::user()->note }}       
  </pre>

<br>
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
        <form id="acceptPaymentForm" action="/payments" method="POST">
        {{ csrf_field() }}
        </form>
        
        <div class="row">
            <div class="col-md-6">
                <small for="">Date</small>
            {{-- <input form="acceptPaymentForm" type="date" class="form-control" name="payment_created" value={{date('Y-m-d')}} required> --}}
            <input  class='form-control col-md-6' type="date" form="acceptPaymentForm" class="" name="payment_created" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required >
            </div>
            <div class="col-md-6">
              <small for="">Acknowledgment Receipt No</small>
              <input class='form-control col-md-6' form="acceptPaymentForm" type="text" class="" id="" name="ar_no" value="{{ $payment_ctr }}" required readonly>
          </div>
        </div>
      
    <hr>

        <div class="row">
          <div class="col-md-12">
         
            <p class="text-left">
              <span id='delete_payment' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove</span>
            <span id="add_payment" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i> Add</span>     
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
      <hr>
       
    </div>
    <div class="modal-footer">
        {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> --}}
        <button form="acceptPaymentForm" id ="addPaymentButton" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50f"></i> Submit</button>
    </div>

</div>
</div>


</div>

<div class="modal fade" id="addBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
<div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Enter Bill Information </h5>

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
        <input type="date" form="addBillForm" class="" name="billing_date" value="{{ Carbon\Carbon::parse($tenant->movein_date)->format('Y-m-d') }}" required >
    </div>
  </div>
 
  <br>
  <div class="row">
    <div class="col">
   
      <p class="text-left">
        <span id='delete_row' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove Bill</span>
      <span id="add_row" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Bill</span>     
      </p>
        <div class="table-responsive text-nowrap">
        <table class = "table table-bordered" id="tab_logic">
            <tr>
                <th>#</th>
                <th>Description</th>
                <th colspan="2">Period Covered</th>
                <th>Amount</th>
                
            </tr>
                <input form="addBillForm" type="hidden" id="no_of_items" name="no_of_items" >
            <tr id='addr1'></tr>
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



<script>
  $(document).ready(function () {

      $("#addPaymentButton").submit(function (e) {

          //disable the submit button
          $("#addPaymentButton").attr("disabled", true);
       
          return true;

      });
  });
</script>

<script type="text/javascript">

//adding moveout charges upon moveout
  $(document).ready(function(){
  var j=1;
  $("#add_payment").click(function(){
      $('#payment'+j).html("<th>"+ (j) +"</th><td><select class='form-control' form='acceptPaymentForm' name='billing_no"+j+"' id='billing_no"+j+"' required> @foreach ($balance as $item)<option value='{{ $item->billing_no.'-'.$item->billing_id }}'> Bill No {{ $item->billing_no }} | {{ $item->billing_desc }} | {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} - {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }} | {{ number_format($item->balance,2) }} </option> @endforeach </select></td><td><input class='form-control'  form='acceptPaymentForm' name='amt_paid"+j+"' id='amt_paid"+j+"' type='number' min='1' step='0.01' required></td><td><select class='form-control'  form='acceptPaymentForm' name='form_of_payment"+j+"' required><option value='Cash'>Cash</option><option value='Bank Deposit'>Bank Deposit</option><option value='Cheque'>Cheque</option></select></td><td>  <input class='form-control'  form='acceptPaymentForm' type='text' name='bank_name"+j+"'></td><td><input class='form-control'  form='acceptPaymentForm' type='text' name='cheque_no"+j+"'></td>");


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



