
<div class="modal fade" id="preterminateContract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preterminate Contract</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form id="preterminateContractForm" action="/property/{{ $property->property_id }}/tenant/{{ $tenant->tenant_id}}/contract/create" method="POST">
            @csrf
  
          </form>
          <div class="row">
            <div class="col">
               <label>Reason</label>
                <select class="form-control" form="preterminateContractForm" name="moveout_reason" id="moveout_reason" required>
                  <option value="" selected>Please select one</option>
                  <option value="End of contract">End of contract</option>
                  <option value="Delinquent">Delinquent</option>
                  <option value="Force majeure">Force majeure</option>
                  <option value="Run away">Run away</option>
                  <option value="Unruly">Unruly</option>
                  <option value="Unsatisfied with the service">Unsatisfied with the service</option>
                </select>
            </div>
        </div>
        <br>
        {{-- <div class="row">
          <div class="col">
            <label for="">Details of the reason</label>
            <textarea  class="form-control" name="reason_details" id="reason_details" cols="30" rows="10">
  
            </textarea>
          </div>
        </div>
        <br> --}}
        <div class="row">
          <div class="col">
              <label>Actual moveout date</label>
              <input type="date" form="preterminateContractForm" class="form-control" name="actual_moveout_at" required >
          </div>
      </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button> 
            <button type="submit" form="contractForm" class="btn btn-primary" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-check"></i> Preterminate</button>
        </div>
    </div>
    </div>
  </div>