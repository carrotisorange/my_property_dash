
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