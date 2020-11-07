<div class="modal fade" id="addInvestor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Owner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form id="addInvestorForm" action="/property/{{ $property->property_id }}/home/{{ $home->unit_id }}/owner" method="POST">
            @csrf
        </form>
        <div class="modal-body">
            <input form="addInvestorForm" type="hidden" value="{{ $home->unit_id }}" name="unit_id">
          
  
            <div class="form-group">
            <small>Name</small>
            <input form="addInvestorForm" type="text"  value="{{ $home->unit_owner }}" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <small>Email</small>
                <input form="addInvestorForm" type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <small>Mobile</small>
                <input form="addInvestorForm" type="text" class="form-control" name="mobile" id="contact_no">
            </div>            
        </div>
        <div class="modal-footer">
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
        <button type="submit" form="addInvestorForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>  
        </div>
    </div>
    </div>
  </div>