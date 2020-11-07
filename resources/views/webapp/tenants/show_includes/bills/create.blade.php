
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